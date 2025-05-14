<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveTypeRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leavetype = LeaveType::get();


        return view('admin.leave-types.index', compact('leavetype'));
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
    public function store(StoreLeaveTypeRequest $request)
    {
        $data = $request->validated();
        $data['assign_days'] = $request->input('assigned');
        $data['early_leave'] = $request->has('early_leave') ? 1 : 0;
        $data['creation_date'] = now();

        LeaveType::create($data);

        return redirect()->route('leave-types.index')->with('success', 'Leave Type created successfully.');
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
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'leave_type' => 'required|string|max:255',
            'assigned' => 'required|integer',
            'description' => 'nullable|string',
            'apply_base' => 'required|string|in:month,year',
            'paid_type' => 'required|string|in:paid,unpaid',
            'early_leave' => 'nullable|boolean',
            'status' => 'required|in:1,2',
        ]);

        // Find the leave type by ID
        $leaveType = LeaveType::findOrFail($id);

        // Update the leave type data
        $leaveType->update([
            'leave_type' => $request->leave_type,
            'assigned_days' => $request->assigned,
            'description' => $request->description,
            'apply_base' => $request->apply_base,
            'paid_type' => $request->paid_type,
            'early_leave' => $request->has('early_leave') ? 1 : 0, // check if early leave checkbox is checked
            'status' => $request->status,
        ]);

        // Return response or redirect as needed
        return redirect()->route('leave-types.index')->with('success', 'Leave Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $leave = LeaveType::find($id);

        if ($leave) {
            $leave->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
