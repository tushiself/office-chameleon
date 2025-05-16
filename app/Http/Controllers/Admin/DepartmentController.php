<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $today = Carbon::today()->toDateString();

        // Get all departments with all users (without attendance filter)
        $departments = Department::with(['users' => function ($query) {
            $query->select('id', 'department_id', 'monthly_salary', 'avatar', 'first_name', 'last_name');
        }])->withCount('users')->get();

        $departmentData = [];

        foreach ($departments as $department) {
            $workingCount = 0;
            $freeCount = 0;
            $userData = [];
            $totalExpense = $this->calculateTotalExpense($department);

            foreach ($department->users as $user) {
                // Check today's attendance
                $attendance = $this->getUserAttendance($user, $today);
                $attendanceStatus = 'Absent';

                if ($attendance) {
                    if ($attendance->check_in_type === 'working') {
                        $workingCount++;
                        $attendanceStatus = 'Working';
                    } elseif ($attendance->check_in_type === 'free') {
                        $freeCount++;
                        $attendanceStatus = 'Free';
                    }
                }

                $userData[] = [
                    'user' => $user,
                    'attendanceStatus' => $attendanceStatus
                ];
            }

            $departmentData[] = [
                'department' => $department,
                'users' => $userData,
                'workingCount' => $workingCount,
                'freeCount' => $freeCount,
                'totalExpense' => $totalExpense
            ];
        }

        return view('admin.department.index', compact('departmentData'));
    }

    /**
     * Get the total expense of the department by summing the monthly salaries of all users.
     */
    private function calculateTotalExpense($department)
    {
        $totalExpense = 0;
        foreach ($department->users as $user) {
            $totalExpense += $user->monthly_salary;
        }
        return $totalExpense;
    }

    /**
     * Get the attendance record for a user on a given date.
     */
    private function getUserAttendance($user, $date)
    {
        return $user->attendances()->whereDate('date', $date)->first();
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
    public function store(Request $request, ImageUploadService $imageUploadService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable', // file validation
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $fileName = $imageUploadService->upload($request->file('logo'), 'department-logos');
            $data['logo'] = $fileName;
        }

        Department::create($data);

        return back()->with('success', 'Department added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, $id, ImageUploadService $imageUploadService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $department = Department::findOrFail($id);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        // Handle logo update if new file is uploaded
        if ($request->hasFile('logo')) {
            $fileName = $imageUploadService->upload($request->file('logo'), 'department-logos');
            $data['logo'] = $fileName;
        }

        $department->update($data);

        return redirect()->back()->with('success', 'Department updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $department = Department::find($id);

        if ($department) {
            // Check if the department has any users assigned
            if ($department->users()->count() > 0) {
                return response()->json(['success' => false, 'message' => 'Department cannot be deleted because it is assigned to users.'], 400);
            }

            $department->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Department not found.'], 404);
    }
}
