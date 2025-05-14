<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordRequest;
use App\Mail\PasswordUpdatedMail;
use App\Models\Attendance;
use App\Models\LoginActivity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Leave;
use App\Models\LeaveType;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class ProfileController extends Controller
{


    public function edit(Request $request)
    {
        $section = $request->input('section', 'settings');

        $user = User::with('department')->where('id', Auth::id())->first();

        $recentLogins = LoginActivity::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        $leaveTypes = LeaveType::all();
        $casualLeave = $leaveTypes->firstWhere('leave_type', 'Casual Leave');
        $totalLeaves = $casualLeave?->assign_days ?? 0;

        $leaves = Leave::with(['user', 'leavetype'])
            ->where('user_id', $user->id)
            ->get();

        $usedLeaves = $leaves->where('leave_status', 1)
            ->where('leave_type', 'Casual Leave')
            ->sum('requested_days');

        $unpaidLeaves = $leaves->where('leave_status', 1)
            ->where('leave_type', '!=', 'Casual Leave')
            ->sum('requested_days');

        $remainingLeaves = $totalLeaves - $usedLeaves;

        return view('admin.profile.edit', compact(
            'recentLogins',
            'section',
            'user',
            'totalLeaves',
            'usedLeaves',
            'remainingLeaves',
            'unpaidLeaves'
        ));
    }

    public function monthlyAttendance(Request $request)
    {
        $user = Auth::user();

        $today = Carbon::now();
        $month = $today->format('m');
        $year = $today->format('Y');

        $attendance = Attendance::with('user')
            ->where('user_id', $user->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year);

        return DataTables::of($attendance)
            ->addIndexColumn()
            ->addColumn('date', fn($row) => Carbon::parse($row->date)->format('d M Y'))
            ->addColumn('user_name', fn($row) => $row->user->first_name . ' ' . $row->user->last_name)
            ->addColumn('check_in_type', fn($row) => $row->check_in_type ?? '—')
            ->addColumn('time_in', fn($row) => $row->time_in ? Carbon::parse($row->time_in)->format('h:i A') : '—')
            ->addColumn('time_out', fn($row) => $row->time_out ? Carbon::parse($row->time_out)->format('h:i A') : '—')
            ->make(true);
    }





    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = User::findOrFail($request->user_id);

        $user->password = hash::make($request->input('new_password'));
        $user->save();

        // Send password updated email
        Mail::to($user->email)->queue(new PasswordUpdatedMail($user));

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully.'
        ]);
    }
}
