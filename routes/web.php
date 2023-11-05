<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


/////// Main Landing Page Routes

Route::get('/', [LandingPageController::class, 'index'])->name('index');
Route::get('/my-vaccine', [LandingPageController::class, 'myVaccine'])->name('myVaccine');
Route::get('/conditions', [LandingPageController::class, 'conditions'])->name('conditions');
Route::get('/vaccination', [LandingPageController::class, 'vaccination'])->name('vaccination');
Route::get('/signin', [LandingPageController::class, 'signin'])->name('signin');
Route::get('/signup', [LandingPageController::class, 'signup'])->name('signup');

////// End Main Landing Page Routes



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



////// Admin Pages //////
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/profile', [AdminController::class, 'AdminProfileInfo'])->name('admin.profileInfo');

    Route::post('/admin/profile/update', [AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');

    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});
////// End Admin Pages //////



////// User Pages //////
Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.index');

    Route::get('/user/profile', [UserController::class, 'UserProfileInfo'])->name('user.profileInfo');

    Route::post('/user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');

    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');

    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
});
////// End User Pages //////




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
