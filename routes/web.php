<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/leave-requests', [LeaveRequestController::class, 'adminIndex'])->name('admin.leave_requests.index');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/leave-requests/{id}/edit', [LeaveRequestController::class, 'edit'])->name('admin.leave_requests.edit');
    Route::patch('/admin/leave-requests/{id}', [LeaveRequestController::class, 'update'])->name('admin.leave_requests.update');
});

// Employee
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/employee/leave-requests', [LeaveRequestController::class, 'index'])->name('employee.leave_requests.index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/employee/leave-requests/create', [LeaveRequestController::class, 'create'])->name('employee.leave_requests.create');
    Route::post('/employee/leave-requests', [LeaveRequestController::class, 'store'])->name('employee.leave_requests.store');
});
