<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware('AdminAuth')->group(function (){
    Route::get('/register-user', [AdminController::class,'createEmployee']);
    Route::post('/user-added', [AdminController::class,'storeEmployee']);
    Route::get('/add-user-salary',[AdminController::class,"salary"]);
    Route::post('/salary-added',[AdminController::class,"addsalary"]);
    Route::get('/user-list',[AdminController::class,"list"])->name('user-list');
    Route::get('/user-data',[AdminController::class,"dataTable"]);
    Route::get('/user-info-data',[AdminController::class,"employeeData"]);
    Route::get('/user-info-table',[AdminController::class,"getEmployeeData"]);
});

