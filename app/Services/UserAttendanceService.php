<?php

namespace App\Services;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserAttendanceService
{
    public function view($request)
    {
        $attendance = Attendance::with('user') // <== Add this to avoid null user
            ->where('user_id', Auth::id())
            ->get();

        return DataTables::of($attendance)
            ->addIndexColumn()
            ->addColumn('user_name', function ($row) {
                return strtoupper(optional($row->user)->first_name . ' ' . optional($row->user)->last_name);
            })
            ->addColumn('date', function ($row) {
                return $row->date ? \Carbon\Carbon::parse($row->date)->format('d F Y') : '—';
            })
            ->addColumn('time_in', function ($row) {
                return $row->time_in ? \Carbon\Carbon::parse($row->time_in)->format('h:i A') : '—';
            })
            ->addColumn('time_out', function ($row) {
                return $row->time_out ? \Carbon\Carbon::parse($row->time_out)->format('h:i A') : '—';
            })
            ->addColumn('total_hr', function ($row) {
                if (!$row->total_hours) return '—';

                $timeParts = explode(':', $row->total_hours); // HH:MM:SS
                $hours = intval($timeParts[0]);
                $minutes = intval($timeParts[1]);

                $hrText = $hours > 0 ? "{$hours} hr" : '';
                $minText = $minutes > 0 ? "{$minutes} min" : '';

                return trim("{$hrText} {$minText}");
            })
            ->addColumn('check_in_type', function ($row) {
                return $row->check_in_type ?? '—';
            })
            ->rawColumns(['user_name', 'date', 'time_in', 'time_out', 'total_hr', 'check_in_type'])
            ->make(true);
    }
}
