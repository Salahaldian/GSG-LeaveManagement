<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leaveTypes = LeaveType::all();
        return view('admin.leave_types.index', compact('leaveTypes'));
    }

    public function create()
    {
        return view('admin.leave_types.create');
    }

    public function store(Request $request)
    {
        LeaveType::create($request->all());

        return redirect()->route('admin.leave_types.index')
            ->with('success', 'Leave type created successfully.');
    }

    public function edit($id)
    {
        $leaveType = LeaveType::findOrFail($id);
        return view('admin.leave_types.edit', compact('leaveType'));
    }

    public function update(Request $request, $id)
    {
        $leaveType = LeaveType::findOrFail($id);
        $leaveType->update($request->all());

        return redirect()->route('admin.leave_types.index')
            ->with('success', 'Leave type updated successfully.');
    }

    public function destroy($id)
    {
        $leaveType = LeaveType::findOrFail($id);
        $leaveType->delete();

        return redirect()->route('admin.leave_types.index')
            ->with('success', 'Leave type deleted successfully.');
    }
}
