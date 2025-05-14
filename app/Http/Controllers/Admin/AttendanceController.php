<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceSession;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use App\Services\AttendanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Collection;
use DB;


class AttendanceController extends Controller
{
    protected $AttendanceService;

    public function __construct(AttendanceService $AttendanceService)
    {
        $this->AttendanceService = $AttendanceService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->AttendanceService->view($request);
        }

        $today = Carbon::today()->toDateString();

        // Get user IDs who are present today
        $presentUserIds = Attendance::where('date', $today)->pluck('user_id')->unique();
        $presentCount = $presentUserIds->count();

        $totalEmployees = User::whereNotIn('role', ['Admin', 'Manager'])->count();
        $absentCount = $totalEmployees - $presentCount;

        return view('admin.attendance.index', compact('presentCount', 'absentCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updateStatus(Request $request)
    {
        $user = Auth::user();
        $today = now()->toDateString();
        $attendance = Attendance::firstOrCreate(
            ['user_id' => $user->id, 'date' => $today],
            ['check_in_type' => 'Free']
        );

        if ($attendance->time_out) {
            return response()->json(['message' => 'Already clocked out'], 400);
        }

        $attendance->check_in_type = $request->status;
        $attendance->save();

        return response()->json(['message' => 'Status updated successfully']);
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();
        $now = Carbon::now();

        $attendance = Attendance::firstOrCreate(
            ['user_id' => $user->id, 'date' => $today],
            ['time_in' => $now, 'check_in_type' => 'working']
        );

        // Already clocked out?
        if ($attendance->time_out) {
            return response()->json(['message' => 'Already clocked out'], 400);
        }

        // Already clocked in → error
        if ($attendance->sessions()->exists()) {
            return response()->json(['message' => 'Already clocked in'], 400);
        }

        // Start session
        $attendance->sessions()->create(['start_time' => $now]);

        return response()->json(['message' => 'Clocked in']);
    }

    public function clockOut(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();
        $now = Carbon::now();

        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today)
            ->first();

        if (!$attendance || $attendance->time_out) {
            return response()->json(['message' => 'Already clocked out'], 400);
        }

        // Close any open session
        $session = $attendance->sessions()->whereNull('end_time')->latest()->first();
        if ($session) {
            $session->update(['end_time' => $now]);
        }

        // Use frontend duration if provided, else calculate
        if ($request->filled('duration')) {
            $totalSeconds = (int)$request->duration;
        } else {
            $totalSeconds = $attendance->sessions->sum(function ($s) {
                return $s->start_time && $s->end_time
                    ? Carbon::parse($s->end_time)->diffInSeconds($s->start_time)
                    : 0;
            });
        }

        $attendance->update([
            'time_out' => $now,
            'total_hours' => gmdate('H:i:s', $totalSeconds)
        ]);

        return response()->json(['message' => 'Clocked out']);
    }



    public function startSession(Request $request)
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->where('date', now()->toDateString())
            ->first();

        if (!$attendance) {
            return response()->json(['message' => 'Attendance not found'], 404);
        }

        AttendanceSession::create([
            'attendance_id' => $attendance->id,
            'start_time' => now(),
        ]);

        return response()->json(['message' => 'Session started']);
    }

    public function pauseSession(Request $request)
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->where('date', now()->toDateString())
            ->first();

        if (!$attendance) {
            return response()->json(['message' => 'Attendance not found'], 404);
        }

        $session = AttendanceSession::where('attendance_id', $attendance->id)
            ->whereNull('end_time')
            ->latest()
            ->first();

        if ($session) {
            $session->end_time = now();
            $session->save();
        }

        return response()->json(['message' => 'Session paused']);
    }




    /**
     * Display the specified resource.
     */


    public function MyAttendance(Request $request)
    {
        $userID = Auth::id();
        $today = Carbon::now();
        $month = $today->format('m');
        $year = $today->format('Y');

        if ($request->ajax()) {
            $attendance = Attendance::with('user')
                ->where('user_id', $userID)
                // ->whereMonth('date', $month)
                // ->whereYear('date', $year)
                ->get();

            return DataTables::of($attendance)
                ->addIndexColumn()
                ->addColumn('user_name', fn($row) => $row->user->first_name . ' ' . $row->user->last_name)
                ->addColumn('time_in', fn($row) => $row->time_in ? Carbon::parse($row->time_in)->format('h:i A') : '—')
                ->addColumn('time_out', fn($row) => $row->time_out ? Carbon::parse($row->time_out)->format('h:i A') : '—')
                ->addColumn('total_hr', function ($row) {
                    if (!$row->total_hours) return '—';

                    $parts = explode(':', $row->total_hours);
                    $h = isset($parts[0]) ? (int)$parts[0] : 0;
                    $m = isset($parts[1]) ? (int)$parts[1] : 0;

                    return trim(($h ? "$h hr" : '') . ' ' . ($m ? "$m min" : ''));
                })

                ->make(true);
        }

        // Attendance days
        $presentDays = Attendance::where('user_id', $userID)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count();

        // Approved leaves (paid + unpaid)
        $approvedLeaveDays = Leave::where('user_id', $userID)
            ->whereMonth('from_date', $month)
            ->whereYear('from_date', $year)
            ->where('leave_status', 1)
            ->sum('requested_days');

        // Total Sundays in month

        $firstDay = Carbon::create($year, $month, 1);
        $daysInMonth = $firstDay->daysInMonth;

        $sundays = collect(range(1, $daysInMonth))->filter(function ($day) use ($year, $month) {
            return Carbon::create($year, $month, $day)->isSunday();
        })->count();


        $totalWorkingDays = $firstDay->daysInMonth - $sundays;
        $absentDays = $approvedLeaveDays;

        return view('admin.attendance.myattendance', compact(
            'totalWorkingDays',
            'presentDays',
            'absentDays'
        ));
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json([
                'success' => false,
                'message' => 'Attendance record not found.'
            ], 404);
        }

        $attendance->delete();

        return response()->json([
            'success' => true,
            'message' => 'Attendance record deleted successfully.'
        ]);
    }
}
