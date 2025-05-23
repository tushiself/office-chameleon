<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\SalaryHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function salaryReport(Request $request)
    {
        $selectedMonth = $request->get('month', Carbon::now()->format('m'));
        $selectedYear = $request->get('year', Carbon::now()->format('Y'));

        $staffMembers = User::where('role', '!=', 'Admin')->get();
        $salaryData = [];

        foreach ($staffMembers as $staff) {
            $staffId = $staff->id;
            // Get latest applicable salary from SalaryHistory
            $monthlySalary = SalaryHistory::where('user_id', $staffId)
                ->where(function ($query) use ($selectedMonth, $selectedYear) {
                    $query->where('year', '<', $selectedYear)
                        ->orWhere(function ($q) use ($selectedMonth, $selectedYear) {
                            $q->where('year', $selectedYear)
                                ->where('month', '<=', $selectedMonth);
                        });
                })
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->value('monthly_salary') ?? $staff->monthly_salary;
            $department = $staff->department->name ?? 'N/A';



            // Attendance
            $attendance = Attendance::where('user_id', $staffId)
                ->whereMonth('date', $selectedMonth)
                ->whereYear('date', $selectedYear)
                ->get();

            $presentDays = 0;
            $totalWorkedSeconds = 0;

            foreach ($attendance as $record) {
                if (!$record->total_hours) continue;

                $totalHr = Carbon::parse('00:00:00')->diffInSeconds(Carbon::parse($record->total_hours));
                $totalWorkedSeconds += $totalHr;

                $dayOfWeek = Carbon::parse($record->date)->dayOfWeek;
                $requiredSeconds = ($dayOfWeek === 6) ? (3.75 * 3600) : (int)(7.75 * 3600);

                if ($totalHr >= $requiredSeconds) {
                    $presentDays++;
                }
            }


            // Total worked time
            $hours = floor($totalWorkedSeconds / 3600);
            $minutes = floor(($totalWorkedSeconds % 3600) / 60);
            $totalWorkedHours = "{$hours} hr {$minutes} min";
            $roundedHours = $hours + ($minutes >= 30 ? 1 : 0);

            // Leave summary
            $leaveSummary = $this->getLeaveSummary($staffId, $selectedMonth, $selectedYear);
            $paidLeaves = $leaveSummary['paid_leaves'];
            $unpaidLeaves = $leaveSummary['unpaid_leaves'];

            // Working days and salary
            $daysInMonth = Carbon::parse("$selectedYear-$selectedMonth-01")->daysInMonth;
            $sundays = 0;
            for ($d = 1; $d <= $daysInMonth; $d++) {
                if (Carbon::parse("$selectedYear-$selectedMonth-$d")->dayOfWeek === 0) {
                    $sundays++;
                }
            }

            $workingDays = $daysInMonth - $sundays;
            $salaryPerDay = $workingDays > 0 ? $monthlySalary / $workingDays : 0;
            $salaryPerHour = $salaryPerDay / 8;

            $effectivePresent = $presentDays + $paidLeaves;
            $absentDays = max($workingDays - $effectivePresent - $unpaidLeaves, 0);


            $attendances = Attendance::where('user_id', $staffId)
                ->whereMonth('date', $selectedMonth)
                ->whereYear('date', $selectedYear)
                ->get();

            $presentDay = $attendances->count();

            $totalAbsent = $workingDays - $presentDay + $unpaidLeaves; // Including unpaid leaves


            $payableSalary = round($salaryPerDay * $presentDay, 2);

            $salaryData[] = [
                'staff_id' => $staffId,
                'full_name' => $staff->first_name . ' ' . $staff->last_name,
                'designation' => $staff->designation,
                'avatar' => $staff->avatar,
                'department' => $department,
                'working_days' => $workingDays,
                'sundays' => $sundays,
                'present_days' => $presentDay,
                'absentDays' => $totalAbsent,
                'paid_leaves' => $paidLeaves,
                'unpaid_leaves' => $totalAbsent,
                'salary_per_day' => round($salaryPerDay, 2),
                'salary_per_hour' => round($salaryPerHour, 2),
                'total_salary' => $monthlySalary,
                'payable_salary' => $payableSalary,
                'total_worked_hours' => $totalWorkedHours,
            ];
        }

        return view('admin.salary-report.index', compact('salaryData', 'selectedMonth', 'selectedYear', 'staffMembers'));
    }
    public function getLeaveSummary($userId, $month, $year): array
    {
        $leaveTypes = LeaveType::all();
        $casualLeave = $leaveTypes->firstWhere('leave_type', 'Casual Leave');

        $leaves = Leave::with(['leavetype'])
            ->where('user_id', $userId)
            ->whereMonth('from_date', $month)
            ->whereYear('from_date', $year)
            ->where('leave_status', 1)
            ->get();

        $convertToDays = function ($hours) {
            if ($hours >= 14) return 2;
            if ($hours >= 11) return 1.5;
            if ($hours >= 6) return 1;
            if ($hours >= 3) return 0.5;
            return 0;
        };

        $paidLeaves = 0;
        if ($casualLeave) {
            $paidLeaves = $leaves->where('leave_type_id', $casualLeave->id)
                ->reduce(function ($carry, $leave) use ($convertToDays) {
                    if ($leave->total_hours) {
                        return $carry + $convertToDays(floatval($leave->total_hours));
                    }
                    return $carry + $leave->requested_days;
                }, 0);
        }

        $unpaidLeaves = $leaves
            ->filter(function ($leave) use ($casualLeave) {
                return !$casualLeave || $leave->leave_type_id !== $casualLeave->id;
            })
            ->reduce(function ($carry, $leave) use ($convertToDays) {
                if ($leave->total_hours) {
                    return $carry + $convertToDays(floatval($leave->total_hours));
                }
                return $carry + $leave->requested_days;
            }, 0);

        $shortfallLeave = $this->calculateShortfallLeaveFromAttendance($userId);
        $unpaidLeaves += $shortfallLeave;

        return [
            'paid_leaves' => $paidLeaves,
            'unpaid_leaves' => $unpaidLeaves,
        ];
    }

    private function calculateShortfallLeaveFromAttendance($userId)
    {
        $attendances = Attendance::where('user_id', $userId)
            ->whereNotNull('date')
            ->whereNotNull('total_hours')
            ->where('total_hours', '!=', '00:00:00')
            ->get()
            ->unique('date');

        $lateDays = 0;
        $lateDetails = [];

        foreach ($attendances as $attendance) {
            $date = Carbon::parse($attendance->date);
            $dayOfWeek = $date->dayOfWeek;
            $workedTime = Carbon::parse($attendance->total_hours);
            $workedSeconds = $workedTime->hour * 3600 + $workedTime->minute * 60 + $workedTime->second;

            $minRequiredSeconds = null;

            if (in_array($dayOfWeek, [1, 2, 3, 4, 5])) {
                $minRequiredSeconds = 7 * 3600 + 45 * 60; // 07:45:00
            } elseif ($dayOfWeek === 6) {
                $minRequiredSeconds = 3 * 3600 + 45 * 60; // 03:45:00
            }

            // Count only if worked time is strictly less than required
            if ($minRequiredSeconds !== null && $workedSeconds < $minRequiredSeconds) {
                $lateDays++;
                $lateDetails[] = [
                    'date' => $attendance->date,
                    'day' => $date->format('l'),
                    'worked' => $attendance->total_hours,
                    'required' => gmdate('H:i:s', $minRequiredSeconds),
                ];
            }
        }

        $shortfallLeave = floor($lateDays / 3) * 0.5;

        return $shortfallLeave;
    }
}
