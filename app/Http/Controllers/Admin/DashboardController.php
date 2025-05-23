<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\SalaryHistory;
use App\Models\User;
use App\Services\AttendanceService;
use App\Services\UserAttendanceService;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    protected $UserAttendanceService;

    public function __construct(UserAttendanceService $UserAttendanceService)
    {
        $this->UserAttendanceService = $UserAttendanceService;
    }
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('user', Auth::user());
        }
        if ($request->ajax()) {
            return $this->UserAttendanceService->view($request);
        }

        $filter = $request->query('filter', '28_days');
        [$pendingleave, $aprovleave, $rejectedleave, $leave] = $this->leaveStats($filter);

        $salaryData = $this->getSalaryReport($request);
        $attendanceSummary = $this->MyAttendance($request);

        $currentDate = Carbon::now(); // Ya requested month/year
        $month = $currentDate->month;
        $year = $currentDate->year;

        $holidays = Holiday::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get()
            ->keyBy(function ($holiday) {
                return Carbon::parse($holiday->date)->day; // 👈 key by day (1-31)
            });


        $today = Carbon::today()->toDateString();
        $attendance = Attendance::with('sessions')->where('user_id', Auth::id())->where('date', $today)->first();

        $isCheckedIn = $attendance?->sessions()->whereNull('end_time')->exists();
        $lastSessionStart = $attendance?->sessions()->whereNull('end_time')->latest()->first()?->time_in;

        $totalPayableSalaryAllStaff = $this->getTotalPayableSalary($month, $year);

        return view('admin.dashboard', [
            'staff'            => $this->getStaffCount(),
            'department'       => $this->getDepartmentCount(),
            'leavetype'        => $this->getLeaveTypeCount(),
            'leave'            => $leave,
            'pendingleave'     => $pendingleave,
            'aprovleave'       => $aprovleave,
            'rejectedleave'    => $rejectedleave,
            'departments'      => Department::withCount('users')->get(),
            'recentAttendance' => $this->getTodayAttendances(),
            'recentLeave'      => $this->getTodayLeaves(),
            'recentStaff'      => $this->getTodayStaff(),
            'departmentData'   => $this->getDepartmentWiseStats(),
            'salaryData'       => $salaryData,
            'attendanceSummary' => $attendanceSummary,
            'currentDate' => $currentDate,
            'holidays' => $holidays,
            'isCheckedIn' =>  $isCheckedIn,
            'lastSessionStart' => $lastSessionStart,
            'totalPayableSalaryAllStaff' => $totalPayableSalaryAllStaff
        ]);
    }


    public function getLeaveSummary($userId, $month, $year)
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

    private function getTotalPayableSalary($month, $year)
    {
        $staffMembers = User::where('role', '!=', 'Admin')->get();
        $totalPayable = 0;

        foreach ($staffMembers as $staff) {
            // Get latest salary
            $monthlySalary = SalaryHistory::where('user_id', $staff->id)
                ->where(function ($query) use ($month, $year) {
                    $query->where('year', '<', $year)
                        ->orWhere(function ($q) use ($month, $year) {
                            $q->where('year', $year)
                                ->where('month', '<=', $month);
                        });
                })
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->value('monthly_salary') ?? $staff->monthly_salary;

            // Calculate working days (excluding Sundays)
            $daysInMonth = Carbon::parse("$year-$month-01")->daysInMonth;
            $sundays = 0;
            for ($d = 1; $d <= $daysInMonth; $d++) {
                if (Carbon::parse("$year-$month-$d")->isSunday()) {
                    $sundays++;
                }
            }
            $workingDays = $daysInMonth - $sundays;
            $salaryPerDay = $workingDays > 0 ? $monthlySalary / $workingDays : 0;

            // Count present days
            $attendances = Attendance::where('user_id', $staff->id)
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->get();

            $presentDays = $attendances->count();

            // Calculate paid/unpaid leaves
            $leaveSummary = app(\App\Http\Controllers\Admin\SalaryController::class)
                ->getLeaveSummary($staff->id, $month, $year);

            $paidLeaves = $leaveSummary['paid_leaves'] ?? 0;
            $effectivePresentDays = $presentDays + $paidLeaves;
            $totalPayable += $salaryPerDay * $effectivePresentDays;
        }

        return round($totalPayable, 2);
    }


    /* ============================================================= */
    /* ================  Private helper methods  ==================== */
    /* ============================================================= */
    private function getStaffCount()
    {
        return User::where('role', '!=', 'Admin')->count();
    }

    private function getDepartmentCount()
    {
        return Department::count();
    }

    private function getLeaveTypeCount()
    {
        return LeaveType::count();
    }

    private function getTodayAttendances()
    {
        $today = now()->toDateString();

        return User::where('role', 'Staff')
            ->with(['attendances' => function ($query) use ($today) {
                $query->whereDate('date', $today);
            }])
            ->get()
            ->map(function ($user) {
                $attendances = $user->attendances->first(); // Only today's attendances (if exists)

                $status = 'Offline';

                if ($attendances) {
                    if ($attendances->time_out !== null) {
                        $status = 'Offline';
                    } else {
                        $status = $attendances->check_in_type ?? 'Offline';
                    }
                }

                return (object) [
                    'user'    => $user,
                    'status'  => $status,
                    'checked_in_at' => $attendances->check_in_time ?? null,
                    'checked_out_at' => $attendances->time_out ?? null,
                ];
            });
    }


    private function getTodayLeaves()
    {
        return Leave::with(['user', 'leavetype'])
            ->whereDate('created_at', today())
            ->latest()->take(5)->get();
    }

    private function getTodayStaff()
    {
        return User::where('role', '!=', 'Admin')
            ->whereDate('created_at', today())
            ->latest()->take(5)->get();
    }

    private function getDepartmentWiseStats()
    {
        $today = today()->toDateString();

        // Get all departments with all users (not just those with attendance today)
        $departments = Department::withCount('users')->with(['users' => function ($query) {
            $query->select('id', 'department_id', 'monthly_salary', 'avatar', 'first_name', 'last_name', 'designation', 'email');
        }])->get();

        return $departments->map(function ($department) use ($today) {
            $workingCount = $freeCount = 0;
            $userData = [];

            foreach ($department->users as $user) {
                // Fetch today's attendance
                $attendance = $this->getUserAttendance($user, $today);

                // Determine attendance status
                $status = match ($attendance->check_in_type ?? null) {
                    'working' => 'Working',
                    'free'    => 'Free',
                    default   => 'N/A',
                };

                // Update counters
                if ($status === 'Working') {
                    $workingCount++;
                } elseif ($status === 'Free') {
                    $freeCount++;
                }

                $userData[] = [
                    'user' => $user,
                    'attendanceStatus' => $status
                ];
            }

            return [
                'department'     => $department,
                'users'          => $userData,
                'workingCount'   => $workingCount,
                'freeCount'      => $freeCount,
                'totalExpense'   => $this->calculateTotalExpense($department),
            ];
        });
    }

    private function leaveStats(string $filter): array
    {
        $user   = Auth::user();
        $role   = strtolower($user->role);

        $start  = match ($filter) {
            'last_month' => Carbon::now()->subMonth()->startOfMonth(),
            'last_year'  => Carbon::now()->subYear()->startOfYear(),
            default      => Carbon::now()->subDays(28),
        };

        $query  = Leave::where('created_at', '>=', $start);
        if (in_array($role, ['staff', 'manager'])) {
            $query->where('user_id', $user->id);
        }

        $leaveCounts = $query->selectRaw('leave_status, COUNT(*) as total')
            ->groupBy('leave_status')
            ->pluck('total', 'leave_status');

        return [
            $leaveCounts[0] ?? 0,          // pending
            $leaveCounts[1] ?? 0,          // approved
            $leaveCounts[2] ?? 0,          // rejected
            $query->count()                // total
        ];
    }

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

    private function getSalaryReport(Request $request)
    {
        $selectedMonth = $request->get('month', Carbon::now()->format('m'));
        $selectedYear = $request->get('year', Carbon::now()->format('Y'));

        $staffMembers = User::where('role', '!=', 'Admin')->get();
        $salaryData = [];

        foreach ($staffMembers as $staff) {
            $staffId = $staff->id;
            $monthlySalary = $staff->monthly_salary;
            $department = $staff->department->name ?? 'N/A';

            $attendance = Attendance::where('user_id', $staffId)
                ->whereMonth('date', $selectedMonth)
                ->whereYear('date', $selectedYear)
                ->get();

            $presentDays = $attendance->count();
            $leaveTypes = LeaveType::all();

            $leaveData = Leave::where('user_id', $staffId)
                ->whereMonth('from_date', $selectedMonth)
                ->whereYear('from_date', $selectedYear)
                ->where('leave_status', 1)
                ->get();

            $paidTypeIds = $leaveTypes->where('paid_type', 'paid')->pluck('id')->toArray();
            $unpaidTypeIds = $leaveTypes->where('paid_type', 'unpaid')->pluck('id')->toArray();

            $paidLeaves = $leaveData->whereIn('leave_type_id', $paidTypeIds)->sum('requested_days');
            $unpaidLeaves = $leaveData->whereIn('leave_type_id', $unpaidTypeIds)->sum('requested_days');

            $sundays = 0;
            $daysInMonth = Carbon::parse("$selectedYear-$selectedMonth-01")->daysInMonth;
            for ($d = 1; $d <= $daysInMonth; $d++) {
                if (Carbon::parse("$selectedYear-$selectedMonth-$d")->dayOfWeek == 0) {
                    $sundays++;
                }
            }

            $workingDays = $daysInMonth - $sundays;
            $salaryPerDay = $workingDays > 0 ? $monthlySalary / $workingDays : 0;

            $effectivePresent = $presentDays + $paidLeaves;
            $absentDays = max($workingDays - $effectivePresent - $unpaidLeaves, 0);
            $deduction = $salaryPerDay * $unpaidLeaves;
            $payableSalary = $salaryPerDay * $effectivePresent;

            $salaryData[] = [
                'staff_id' => $staff->staff_id,
                'full_name' => $staff->first_name . ' ' . $staff->last_name,
                'avatar' => $staff->avatar,
                'department' => $department,
                'working_days' => $workingDays,
                'sundays' => $sundays,
                'present_days' => $presentDays,
                'paid_leaves' => $paidLeaves,
                'unpaid_leaves' => $unpaidLeaves,
                'salary_per_day' => $salaryPerDay,
                'total_salary' => $monthlySalary,
                'payable_salary' => $payableSalary,
            ];
        }

        return $salaryData;
    }


    private function MyAttendance(Request $request)
    {
        $userID = Auth::user()->id;

        // Always use current month and year
        $selectedMonth = Carbon::now()->format('m');
        $selectedYear = Carbon::now()->format('Y');

        // Fetch attendance for current month
        $attendances = Attendance::where('user_id', $userID)
            ->whereMonth('date', $selectedMonth)
            ->whereYear('date', $selectedYear)
            ->get();

        $presentDays = $attendances->count();

        // Approved leaves
        $leaveData = Leave::where('user_id', $userID)
            ->whereMonth('from_date', $selectedMonth)
            ->whereYear('from_date', $selectedYear)
            ->where('leave_status', 1)
            ->get();

        // All approved leave days (paid + unpaid)
        $approvedLeaveDays = $leaveData->sum('requested_days');

        // Count Sundays in the month
        $sundays = collect(range(1, Carbon::parse("$selectedYear-$selectedMonth-01")->daysInMonth))
            ->filter(fn($day) => Carbon::parse("$selectedYear-$selectedMonth-$day")->isSunday())
            ->count();

        // Total working days = all days - Sundays
        $totalWorkingDays = Carbon::parse("$selectedYear-$selectedMonth-01")->daysInMonth - $sundays;

        // Present Days = Attendance + Approved Leaves
        $adjustedPresentDays = $presentDays;

        // Absent = Working Days - (Present + Approved Leaves)
        $absentDays = max($totalWorkingDays - $adjustedPresentDays, 0);

        // Handle AJAX DataTable request
        if ($request->ajax()) {
            // Show all attendances for the current month
            $monthlyAttendance = Attendance::where('user_id', $userID)
                ->get();
            return DataTables::of($monthlyAttendance)
                ->addIndexColumn()
                ->addColumn('user_name', fn($row) => $row->user->first_name . ' ' . $row->user->last_name)
                ->addColumn('time_in', fn($row) => Carbon::parse($row->time_in)->format('h:i A'))
                ->addColumn('time_out', fn($row) => $row->time_out ? Carbon::parse($row->time_out)->format('h:i A') : null)
                ->addColumn('total_hr', function ($row) {
                    if (!$row->total_hours) return null;

                    $timeParts = explode(':', $row->total_hours); // total_hours = "HH:MM:SS"
                    $hours = intval($timeParts[0]);
                    $minutes = intval($timeParts[1]);

                    $hrText = $hours > 0 ? "{$hours} hr" : '';
                    $minText = $minutes > 0 ? "{$minutes} min" : '';

                    return trim("{$hrText} {$minText}");
                })


                ->make(true);
        }

        // Pass attendance summary to the view
        return  [
            'workingDays' => $totalWorkingDays,
            'presentDays' => $adjustedPresentDays,
            'absentDays' => $approvedLeaveDays,
        ];
    }



    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
