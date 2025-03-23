<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::middleware('AdminAuth')->group(function () {
    Route::get('roles',[RoleController::class,"roles"]);
    Route::get('/roles-data',[RoleController::class,"getRolesData"]);
});