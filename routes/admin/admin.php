<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware('AdminAuth')->group(function () {
    Route::get('/admininfo', [AdminController::class,'admininfo']);
    Route::put('/update-admin-info', [AdminController::class,'updateAdmin']);
    Route::get('/edit-admin-detail', [AdminController::class, 'editadmin'])->name('editadmin');
    Route::post('/admininfo-added', [AdminController::class,'addAdmininfo'])->name('addinfo');
    Route::get('/leave-list', [AdminController::class,'leaveInfo']);
    Route::get('/getLeaveInfo', [AdminController::class,'getLeaveInfo']);
    Route::get('/leave-update', [AdminController::class,'leaveFile']);
    Route::put('/leave-updated', [AdminController::class,'updateLeave']);
    Route::get('/edit-user-details/{id?}', [AdminController::class, 'editUserDetails'])->name('edit-user');
    Route::put('/update-user/{id?}', [AdminController::class, 'updateUser'])->name('update-user');
    Route::post('/delete-user/{id?}', [AdminController::class, 'deleteUser'])->name('delete-user');

});