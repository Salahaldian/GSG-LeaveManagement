<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\ShowAllMyRequests;
use App\Http\Requests\StoreLeaveRequest;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Notifications\RequestNotification;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShowAllMyRequests $request)
    {
        $data = $request->validated();
        $user = User::query()
            ->where('id', '=', $data['user_id'])
            ->where('type', '=', 'admin')
            ->first();
        if ($user) {
            return LeaveRequest::query()
                ->where('accept', '=', null)
                ->get();
        }
        return LeaveRequest::query()
            ->where('user_id', '=', $data['user_id'])
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    public function store(StoreLeaveRequest $request)
    {
        $data = $request->validated();
        $user = User::query()
            ->where('id', '=', $data['user_id'])
            ->first();
        LeaveRequest::query()
            ->create(
                [
                    'type' => $data['type'],
                    'reason' => $data['reason'],
                    'user_id' => $data['user_id'],
                ]);
        return $user->notify(new RequestNotification($data['user_id']));
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
    public function update(AdminUpdateRequest $request)
    {
        $data = $request->validated();
        $request = LeaveRequest::query()
            ->where('id', '=', $data['request_id'])
            ->first();

        if ($data['accept'] == 0) {
            $request->update(
                [
                    'accept' => $data['accept'],
                    'status' => 'rejected',
                ]);
            return response(
                [
                    'message' => 'I have successfully rejected the request '
                ], 200);
        } else if ($data['accept'] == 1) {
            $request->update(
                [
                    'accept' => $data['accept'],
                    'status' => 'accepted',
                ]);
            return response(
                [
                    'message' => 'I have successfully accepted the request '
                ], 200);
        }
    }
}
