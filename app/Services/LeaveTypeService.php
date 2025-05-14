<?php

namespace App\Services;

use App\Models\LeaveType;
use Yajra\DataTables\DataTables;

class LeaveTypeService
{
    public function getLeaveTypeDataTable()
    {
        $leaveTypes = LeaveType::get();

        return DataTables::of($leaveTypes)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                return $row->status
                    ? '<span class="text-darkgreen">Active</span>'
                    : '<span class="text-red-500">Inactive</span>';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('jS F, Y - H:i');
            })
            ->addColumn('action', function ($row) {
                return '
                    <div class="flex items-center gap-3">
                        <button class="edit-btn text-lightgray hover:text-purple" data-id="' . $row->id . '">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-btn text-lightgray hover:text-red-400" data-id="' . $row->id . '">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
}
