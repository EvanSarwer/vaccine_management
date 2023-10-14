<?php

use App\Http\Controllers\LandingPageController;
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
Route::get('/signin', [LandingPageController::class, 'signin'])->name('signin');
Route::get('/signup', [LandingPageController::class, 'signup'])->name('signup');



////// End Main Landing Page Routes