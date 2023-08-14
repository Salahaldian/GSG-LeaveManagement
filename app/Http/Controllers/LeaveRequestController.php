<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function adminIndex()
    {
        $leaveRequests = LeaveRequest::all();
        return view('admin.leave_requests.index', compact('leaveRequests'));
    }

    public function edit($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        return view('admin.leave_requests.edit', compact('leaveRequest'));
    }

    public function update(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->status = $request->status;
        $leaveRequest->save();

        return redirect()->route('admin.leave_requests.index');
    }

    public function destroy($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->delete();

        return redirect()->route('admin.leave_requests.index');
    }
}
