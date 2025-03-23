<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware('EmployeeAuth')->group(function () {
    Route::post('/add-employee-info', [UserController::class, 'adduserInfo']);
    Route::get('/edit-employee-details/{id?}', [UserController::class, 'editemployee'])->name('editemployee');
    Route::put('/update-employee-info', [UserController::class,'update']);
    Route::get('/apply-leave',[UserController::class,'leave']);
    Route::post('/leave-marked',[UserController::class,'employeeLeave']);
    Route::get('/check-status',[UserController::class,'leaveStatus']);
});

