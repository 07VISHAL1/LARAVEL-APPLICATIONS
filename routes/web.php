<?php  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [HomeController::class,'index'])->name('home');

include __DIR__.'/auth.php';
include __DIR__.'/admin/admin.php';
include __DIR__.'/admin/salary.php';
include __DIR__.'/admin/employeeInfo.php';
include __DIR__.'/profile.php';
include __DIR__.'/role.php';
include __DIR__.'/user/user.php';




