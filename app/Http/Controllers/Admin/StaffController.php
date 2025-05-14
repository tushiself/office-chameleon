<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffStoreRequest;
use App\Mail\StaffWelcomeMail;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\LoginActivity;
use App\Models\User;
use App\Services\ImageUploadService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // If department is selected, filter the users
        $departmentId = $request->get('department'); // Get the selected department from the request

        $departments = Department::withCount(['users'])->get();

        // If department ID is provided, filter users by department
        if ($departmentId) {
            $users = User::where('role', '!=', 'Admin')
                ->where('department_id', $departmentId)  // Add the department filter
                ->get();
        } else {
            $users = User::where('role', '!=', 'Admin')->get();
        }

        return view('admin.staff.index', compact('departments', 'users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::withCount(['users'])->get();
        $user = User::where('role', '!=', 'Admin')->get();
        return view('admin.staff.create', compact('departments', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StaffStoreRequest $request, ImageUploadService $imageUploadService)
    {

        $data = $request->validated();

        /* ---------- avatar upload (unchanged) ---------- */
        if ($request->hasFile('avatar')) {
            $fileName           = $imageUploadService->upload($request->file('avatar'), 'avatar');
            $data['avatar']     = $fileName;
        }

        /* ---------- generate initial password ---------- */
        $plainPassword = $data['password'] ?? str()->random(10);   // generate if form didn’t include
        $data['password'] = Hash::make($plainPassword);

        /* ---------- mark as first‑time login ---------- */
        $data['password_reset'] = 0;               // force reset on first login
        $data['role']           = 'Staff';         // or whatever role you need

        /* ---------- create user ---------- */
        $user = User::create($data);

        /* ---------- send welcome mail (queued) ---------- */
        Mail::to($user->email)->queue(new StaffWelcomeMail($user, $plainPassword));

        return redirect()->route('new-staff.index')
            ->with('success', 'Staff created and welcome e‑mail sent!');
    }

    public function generateStaffID()
    {
        // Get the last assigned staff ID
        $lastStaff = User::orderBy('staff_id', 'desc')->first();
        if ($lastStaff) {
            // Extract the numeric part of the staff ID
            $lastNumber = (int)substr($lastStaff->staff_id, 4); // Remove 'LLM ' prefix and cast to integer

            // Increment and pad the number to ensure 3 digits
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // If no staff ID exists, start from 'LLM 001'
            $newNumber = '001';
        }

        // Generate the new staff ID
        $newStaffId = 'CHAM' . $newNumber;

        return response()->json([
            'new_staff_id' => $newStaffId
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $user = User::with('department')->where('id', $id)->firstOrFail();

        if ($request->ajax()) {
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

        $section = $request->input('section', 'settings');

        $recentLogins = LoginActivity::where('user_id', $id)
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

        return view('admin.staff.show', compact(
            'recentLogins',
            'section',
            'user',
            'totalLeaves',
            'usedLeaves',
            'remainingLeaves',
            'unpaidLeaves'
        ));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departments = Department::withCount(['users'])->get();
        $user = User::with('department')->find($id);
        return view('admin.staff.edit', compact('departments', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImageUploadService $imageUploadService)
    {
        $staff = User::findOrFail($request->id);

        // Handle avatar upload if provided
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');

            // Optionally: delete the old avatar if it exists
            if ($staff->avatar) {
                $imageUploadService->delete('admin-uploads/avatar/' . $staff->avatar);
            }

            $fileName = $imageUploadService->upload($image, 'avatar');
            $data['avatar'] = $fileName;
        }

        // Update the staff record
        $staff->update($request->all());

        return redirect()->route('new-staff.index')->with('success', 'Staff updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        // Check if the user exists before trying to delete
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User cannot be deleted because user not found.'], 400);
        }

        // Delete the user
        $user->delete();

        return response()->json(['success' => true]);
    }
}
