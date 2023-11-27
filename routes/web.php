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


    Route::get('/appuser/create', [AdminController::class, 'AppUserCreateView'])->name('appUser.create');

    Route::post('/appuser/create', [AdminController::class, 'AppUserCreatePost'])->name('appUser.create.post');

    Route::get('/appuser/edit/{id}', [AdminController::class, 'AppUserEditView'])->name('appUser.edit');

    Route::post('/appuser/edit', [AdminController::class, 'AppUserEditPost'])->name('appUser.edit.post');

    Route::get('/appuser/status/{id}/{status}', [AdminController::class, 'AppUserStatusUpdate'])->name('appUser.status');


    ////Property Operation Routes////
    Route::get('/admin/disease_list', [AdminController::class, 'DiseaseList'])->name('admin.disease_list');

    Route::get('/admin/disease-create', [AdminController::class, 'DiseaseCreateView'])->name('admin.disease.create');

    Route::post('/admin/disease-create', [AdminController::class, 'DiseaseCreatePost'])->name('admin.disease.create.post');

    Route::get('/admin/disease-edit/{id}', [AdminController::class, 'DiseaseEditView'])->name('admin.disease.edit');

    Route::get('/admin/disease-delete/{id}', [AdminController::class, 'DiseaseDelete'])->name('admin.disease.delete');

    Route::post('/admin/disease-edit', [AdminController::class, 'DiseaseEditPost'])->name('admin.disease.edit.post');

    Route::get('/admin/disease-info/{id}', [AdminController::class, 'DiseaseInfo'])->name('admin.disease.info');

    Route::get('/admin/disease/vaccine-create/{disease_id}', [AdminController::class, 'DiseaseVaccineCreateView'])->name('admin.disease.vaccine.create');

    Route::post('/admin/disease/vaccine-create', [AdminController::class, 'DiseaseVaccineCreatePost'])->name('admin.disease.vaccine.create.post');

    Route::get('/admin/disease/vaccine-edit/{id}/{disease_id}', [AdminController::class, 'DiseaseVaccineEditView'])->name('admin.disease.vaccine.edit');

    Route::post('/admin/disease/vaccine-edit', [AdminController::class, 'DiseaseVaccineEditPost'])->name('admin.disease.vaccine.edit.post');

    Route::get('/admin/disease/vaccine-delete/{id}', [AdminController::class, 'DiseaseVaccineDelete'])->name('admin.disease.vaccine.delete');
    


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
