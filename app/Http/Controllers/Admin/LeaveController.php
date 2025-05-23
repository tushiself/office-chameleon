<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
    
        // Fetch leave types
        $leaveTypes = LeaveType::all();
        $casualLeave = $leaveTypes->firstWhere('leave_type', 'Casual Leave');
        $totalLeaves = $casualLeave?->assign_days ?? 0;
    
        // Base query for current user's leaves
        $leaveQuery = Leave::with(['user', 'leavetype'])
            ->where('user_id', $userId);
    
        // Optional filter by status
        if ($request->filled('status')) {
            $leaveQuery->where('leave_status', $request->status);
        }
    
        $leave = $leaveQuery->get();
    
        // Calculate leave stats
        $usedLeaves = $leave->where('leave_status', 1)
            ->where('leave_type', 'Casual Leave')
            ->sum('requested_days');
    
        $unpaidLeaves = $leave->where('leave_status', 1)
            ->where('leave_type', '!=', 'Casual Leave')
            ->sum('requested_days');
    
        $remainingLeaves = $totalLeaves - $usedLeaves;
        $leavePercentage = $totalLeaves ? ($usedLeaves / $totalLeaves) * 100 : 0;
    
        return view('admin.leave.index', compact(
            'leave',
            'leaveTypes',
            'totalLeaves',
            'usedLeaves',
            'remainingLeaves',
            'leavePercentage',
            'unpaidLeaves'
        ));
    }
    

    public function Allleave(Request $request)
    {
        $leavetype = LeaveType::get();
        $leave = Leave::query();

        if ($request->filled('status')) {
            $leave->where('leave_status', $request->status);
        }

        $leave = $leave->with(['user', 'leavetype'])->get();
        return view('admin.leave.all-leave', compact(
            'leavetype',
            'leave',

        ));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leavetype = LeaveType::get();
        return view('admin.leave.create', compact('leavetype'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'leave_type_id' => 'required|integer',
            'from_date' => 'required|date|after_or_equal:' . now()->toDateString(),
            'to_date' => 'required|date|after_or_equal:from_date',
            'remarks' => 'nullable|string',
        ]);

        // Calculate requested days
        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);
        $requested_days = $from->diffInDays($to) + 1;

        // Store leave
        Leave::create([
            'leave_type_id'   => $request->leave_type_id,
            'from_date'       => $request->from_date,
            'to_date'         => $request->to_date,
            'requested_days'  => $requested_days,
            'reviewed_date'   => now(),
            'user_id'         => Auth::id(),
            'remarks'         => $request->remarks,
        ]);

        return redirect()->route('leave.index')->with('success', 'Leave submitted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);
        $leave->leave_status = $request->status;
        $leave->save();

        return response()->json(['message' => 'Status updated']);
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
        $leavetype = LeaveType::all();
        $leave = Leave::findOrFail($id);
        return view('admin.leave.edit', compact('leavetype', 'leave'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'leave_id' => 'required|exists:leaves,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'remarks' => 'nullable|string',
        ]);

        $leave = Leave::findOrFail($request->leave_id);
        $leave->leave_type_id = $request->leave_type_id;
        $leave->from_date = $request->from_date;
        $leave->to_date = $request->to_date;
        $leave->requested_days = \Carbon\Carbon::parse($request->from_date)->diffInDays(\Carbon\Carbon::parse($request->to_date)) + 1;
        $leave->remarks = $request->remarks;
        $leave->save();

        return redirect()->route('leave.index')->with('success', 'Leave updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Leave = Leave::find($id);

        if ($Leave) {


            $Leave->delete();
            return response()->json(['success' => true]);
        }
    }
}
