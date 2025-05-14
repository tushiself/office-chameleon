<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function salaryReport(Request $request)
    {
        // Get selected month and year, or use current values if not provided
        $selectedMonth = $request->get('month', Carbon::now()->format('m'));
        $selectedYear = $request->get('year', Carbon::now()->format('Y'));

        // Get all staff data
        $staffMembers = User::where('role', '!=', 'Admin')->get();

        $salaryData = [];

        foreach ($staffMembers as $staff) {
            $staffId = $staff->id;
            $monthlySalary = $staff->monthly_salary;
            $department = $staff->department->name ?? 'N/A';

            // Get attendance for the selected month and year
            $attendance = Attendance::where('user_id', $staffId)
                ->whereMonth('date', $selectedMonth)
                ->whereYear('date', $selectedYear)
                ->get();

            $presentDays = $attendance->count();

            // Fetch all leave types
            $leaveTypes = LeaveType::all();

            // Get leave data for the selected staff, month, and year with approved status
            $leaveData = Leave::where('user_id', $staffId)
                ->whereMonth('from_date', $selectedMonth)
                ->whereYear('from_date', $selectedYear)
                ->where('leave_status', 1) // Approved leaves
                ->get();

            // Separate paid and unpaid leave type IDs
            $paidTypeIds = $leaveTypes->where('paid_type', 'paid')->pluck('id')->toArray();
            $unpaidTypeIds = $leaveTypes->where('paid_type', 'unpaid')->pluck('id')->toArray();

            // Sum requested_days for each type
            $paidLeaves = $leaveData->whereIn('leave_type_id', $paidTypeIds)->sum('requested_days');
            $unpaidLeaves = $leaveData->whereIn('leave_type_id', $unpaidTypeIds)->sum('requested_days');



            // Calculate Sundays
            $sundays = 0;
            $daysInMonth = Carbon::parse("$selectedYear-$selectedMonth-01")->daysInMonth;
            for ($d = 1; $d <= $daysInMonth; $d++) {
                if (Carbon::parse("$selectedYear-$selectedMonth-$d")->dayOfWeek == 0) {
                    $sundays++;
                }
            }

            $workingDays = $daysInMonth - $sundays;
            $salaryPerDay = $workingDays > 0 ? $monthlySalary / $workingDays : 0;

            // Calculate total salary after deductions
            $effectivePresent = $presentDays + $paidLeaves;
            $absentDays = max($workingDays - $effectivePresent - $unpaidLeaves, 0);
            $deduction = $salaryPerDay * $unpaidLeaves;
            $payableSalary = $salaryPerDay * $effectivePresent;

            // Store data
            $salaryData[] = [
                'staff_id' => $staffId,
                'full_name' => $staff->first_name . ' ' . $staff->last_name,
                'designation' => $staff->designation ,
                'avatar' => $staff->avatar ,
                'department' => $department,
                'working_days' => $workingDays,
                'sundays' => $sundays,
                'present_days' => $presentDays,
                'absentDays' => $absentDays,
                'paid_leaves' => $paidLeaves,
                'unpaid_leaves' => $unpaidLeaves,
                'salary_per_day' => $salaryPerDay,
                'total_salary' => $monthlySalary,
                'payable_salary' => $payableSalary,
            ];
        }

        // Pass data to the view
        return view('admin.salary-report.index', compact('salaryData', 'selectedMonth', 'selectedYear', 'staffMembers'));
    }
}
