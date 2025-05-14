<?php

namespace App\Services;

use App\Models\Attendance;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class AttendanceService
{
    public function view($request)
    {
        $today = Carbon::today()->toDateString();
        // Fetch attendance data and join with users table to get names
        $attendance = Attendance::with('user')->where('date', $today)
            ->whereHas('user', function ($query) {
                $query->whereNotIn('role', ['Admin', 'Manager']);
            })
            ->get();


        return DataTables::of($attendance)
            ->addIndexColumn()
            ->addColumn('user_name', function ($row) {
                return strtoupper($row->user->first_name . ' ' . $row->user->last_name);
            })
            ->addColumn('date', function ($row) {
                return \Carbon\Carbon::parse($row->date)->format('d F Y');
            })
            ->addColumn('time_in', function ($row) {
                return \Carbon\Carbon::parse($row->time_in)->format('h:i A');
            })
            ->addColumn('time_out', function ($row) {
                return \Carbon\Carbon::parse($row->time_out)->format('h:i A');
            })
            ->addColumn('total_hr', function ($row) {
                if (!$row->total_hours) return null;

                $timeParts = explode(':', $row->total_hours); // total_hours = "HH:MM:SS"
                $hours = intval($timeParts[0]);
                $minutes = intval($timeParts[1]);

                $hrText = $hours > 0 ? "{$hours} hr" : '';
                $minText = $minutes > 0 ? "{$minutes} min" : '';

                return trim("{$hrText} {$minText}");
            })
            ->addColumn('action', function ($row) {
                return '
                    <button data-id="' . $row->id . '" class="delete-attendance-btn cursor-pointer text-lightgray duration-300 hover:text-red-400">
                        <svg width="12" height="15" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.8462 1.84615H8.30769V1.38462C8.30769 0.619904 7.68779 0 6.92308 0H5.07692C4.31221 0 3.69231 0.619904 3.69231 1.38462V1.84615H1.15385C0.516606 1.84615 0 2.36276 0 3V3.92308C0 4.17799 0.206625 4.38462 0.461538 4.38462H11.5385C11.7934 4.38462 12 4.17799 12 3.92308V3C12 2.36276 11.4834 1.84615 10.8462 1.84615ZM4.61538 1.38462C4.61538 1.13019 4.8225 0.923077 5.07692 0.923077H6.92308C7.1775 0.923077 7.38462 1.13019 7.38462 1.38462V1.84615H4.61538V1.38462ZM0.875885 5.30769C0.856367 5.30769 0.837052 5.31166 0.81911 5.31934C0.801169 5.32702 0.784974 5.33827 0.771505 5.3524C0.758037 5.36652 0.747576 5.38324 0.740756 5.40152C0.733935 5.41981 0.730898 5.43929 0.731827 5.45879L1.1126 13.4504C1.14779 14.19 1.75529 14.7692 2.49548 14.7692H9.50452C10.2447 14.7692 10.8522 14.19 10.8874 13.4504L11.2682 5.45879C11.2691 5.43929 11.2661 5.41981 11.2592 5.40152C11.2524 5.38324 11.242 5.36652 11.2285 5.3524C11.215 5.33827 11.1988 5.32702 11.1809 5.31934C11.1629 5.31166 11.1436 5.30769 11.1241 5.30769H0.875885ZM7.84615 6.46154C7.84615 6.20654 8.05269 6 8.30769 6C8.56269 6 8.76923 6.20654 8.76923 6.46154V12.4615C8.76923 12.7165 8.56269 12.9231 8.30769 12.9231C8.05269 12.9231 7.84615 12.7165 7.84615 12.4615V6.46154ZM5.53846 6.46154C5.53846 6.20654 5.745 6 6 6C6.255 6 6.46154 6.20654 6.46154 6.46154V12.4615C6.46154 12.7165 6.255 12.9231 6 12.9231C5.745 12.9231 5.53846 12.7165 5.53846 12.4615V6.46154ZM3.23077 6.46154C3.23077 6.20654 3.43731 6 3.69231 6C3.94731 6 4.15385 6.20654 4.15385 6.46154V12.4615C4.15385 12.7165 3.94731 12.9231 3.69231 12.9231C3.43731 12.9231 3.23077 12.7165 3.23077 12.4615Z" fill="currentColor"/>
                        </svg>
                    </button>
                ';
            })
            ->rawColumns(['action'])

            ->make(true);
    }
}
