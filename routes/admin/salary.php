<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaryController;

Route::middleware('AdminAuth')->group(function () {
    Route::get('/salary-table', [SalaryController::class,'salaryTable']);
    Route::get('/salary-data', [SalaryController::class,'getSalaryData']);
    Route::get('/edit-salary', [SalaryController::class,'editSalary']);
    Route::put('/save-salary', [SalaryController::class,'saveSalary']);

});