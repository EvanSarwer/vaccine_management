<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyOperationController;
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
Route::get('/blogs', [LandingPageController::class, 'blogs'])->name('blogs');
Route::get('/signin', [LandingPageController::class, 'signin'])->name('signin');
Route::get('/signup', [LandingPageController::class, 'signup'])->name('signup');

Route::get('/sendmail', [AdminController::class, 'SendMail'])->name('sendmail');

////// End Main Landing Page Routes


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/vaccination-details/pdf/{id}', [CommonController::class, 'VaccinationDetailsPdfView'])->name('vaccination.pdf.details');
    Route::get('/vaccination-certificate/pdf/{id}', [CommonController::class, 'VaccinationCertificatePdfView'])->name('vaccination.pdf.certificate');

    Route::get('/message/seen', [CommonController::class, 'MessageSeen'])->name('message.seen');
    Route::get('/message/list', [CommonController::class, 'MessageList'])->name('message.list');

    Route::get('/division/to/centers/{division}', [CommonController::class, 'DivisionToCenter'])->name('division.to.center');


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


    ////Property Operation Routes Disease////
    Route::get('/admin/disease_list', [AdminController::class, 'DiseaseList'])->name('admin.disease_list');

    Route::get('/admin/disease-create', [AdminController::class, 'DiseaseCreateView'])->name('admin.disease.create');

    Route::post('/admin/disease-create', [AdminController::class, 'DiseaseCreatePost'])->name('admin.disease.create.post');

    Route::get('/admin/disease-delete/{id}', [AdminController::class, 'DiseaseDelete'])->name('admin.disease.delete');

    Route::get('/admin/disease-edit/{id}', [AdminController::class, 'DiseaseEditView'])->name('admin.disease.edit');

    Route::post('/admin/disease-edit', [AdminController::class, 'DiseaseEditPost'])->name('admin.disease.edit.post');

    Route::get('/admin/disease-info/{id}', [AdminController::class, 'DiseaseInfo'])->name('admin.disease.info');

    Route::get('/admin/disease/vaccine-create/{disease_id}', [AdminController::class, 'DiseaseVaccineCreateView'])->name('admin.disease.vaccine.create');

    Route::post('/admin/disease/vaccine-create', [AdminController::class, 'DiseaseVaccineCreatePost'])->name('admin.disease.vaccine.create.post');

    Route::get('/admin/disease/vaccine-edit/{id}/{disease_id}', [AdminController::class, 'DiseaseVaccineEditView'])->name('admin.disease.vaccine.edit');

    Route::post('/admin/disease/vaccine-edit', [AdminController::class, 'DiseaseVaccineEditPost'])->name('admin.disease.vaccine.edit.post');

    Route::get('/admin/disease/vaccine-delete/{id}', [AdminController::class, 'DiseaseVaccineDelete'])->name('admin.disease.vaccine.delete');
    

    ////Property Operation Routes Vaccines////
    Route::get('/admin/vaccine_list', [AdminController::class, 'VaccineList'])->name('admin.vaccine_list');
    
    Route::get('/admin/vaccine-create', [AdminController::class, 'VaccineCreateView'])->name('admin.vaccine.create');

    Route::post('/admin/vaccine-create', [AdminController::class, 'VaccineCreatePost'])->name('admin.vaccine.create.post');

    Route::get('/admin/vaccine-edit/{id}', [AdminController::class, 'VaccineEditView'])->name('admin.vaccine.edit');

    Route::post('/admin/vaccine-edit', [AdminController::class, 'VaccineEditPost'])->name('admin.vaccine.edit.post');

    Route::get('/admin/vaccine-delete/{id}', [AdminController::class, 'VaccineDelete'])->name('admin.vaccine.delete');


    
    ////Property Operation Routes Center////
    Route::get('/admin/center_list/{division}', [AdminController::class, 'CenterList'])->name('admin.center_list');

    Route::get('/admin/center-create', [AdminController::class, 'CenterCreateView'])->name('admin.center.create');

    Route::post('/admin/center-create', [AdminController::class, 'CenterCreatePost'])->name('admin.center.create.post');

    Route::get('/admin/center-edit/{id}', [AdminController::class, 'CenterEditView'])->name('admin.center.edit');

    Route::post('/admin/center-edit', [AdminController::class, 'CenterEditPost'])->name('admin.center.edit.post');

    Route::get('/admin/center-delete/{id}', [AdminController::class, 'CenterDelete'])->name('admin.center.delete');

    //// Center wise Vaccine Stock ////
    Route::get('/admin/vaccine-stock/list/{center_id}', [AdminController::class, 'VaccineStockList'])->name('admin.vaccine.stock.list');

    Route::post('/admin/vaccine-stock/add', [AdminController::class, 'VaccineStockAdd'])->name('admin.vaccine.stock.add.post');


    ////Property Operation Routes Vaccination Status Dose////
    Route::get('/admin/vaccination-status_list', [AdminController::class, 'VaccinationStatusList'])->name('admin.vaccinationStatus_list');

    Route::get('/admin/vaccinationStatus-vaccine/{id}', [AdminController::class, 'VaccinationStatusVaccine'])->name('admin.vaccinationStatus.vaccine');

    Route::get('/admin/vaccine-registration', [AdminController::class, 'VaccineRegistrationView'])->name('admin.vaccine.registration');

    Route::post('/admin/vaccine-registration', [AdminController::class, 'VaccineRegistrationPost'])->name('admin.vaccine.registration.post');

    Route::get('/admin/underprivileged/vaccine-registration', [AdminController::class, 'UnderprivilegedVaccineRegistrationView'])->name('admin.underprivileged.vaccine.registration');

    Route::post('/admin/underprivileged/vaccine-registration', [AdminController::class, 'UnderprivilegedVaccineRegistrationPost'])->name('admin.underprivileged.vaccine.registration.post');

    Route::get('/admin/vaccine-registration-update/{id}', [AdminController::class, 'VaccineRegistrationUpdateView'])->name('admin.vaccine.registration.update');

    Route::post('/admin/vaccine-registration-update', [AdminController::class, 'VaccineRegistrationUpdatePost'])->name('admin.vaccine.registration.update.post');

    Route::get('/admin/vaccination-details/{id}', [AdminController::class, 'VaccinationDetailsView'])->name('admin.vaccination.details');


    // Notification Meassage ///////
    Route::get('/admin/message/list', [AdminController::class, 'MessageList'])->name('admin.message.list');

    Route::get('/admin/send-mail-nitification/{email?}', [AdminController::class, 'SendMailNotificationView'])->name('admin.send.email.notification');

    Route::post('/admin/send-mail-nitification', [AdminController::class, 'SendMailNotificationPost'])->name('admin.send.email.notification.post');


    // Start Edit Page Property Operations
    Route::get('/admin/pageProperty/edit', [PropertyOperationController::class, 'PagePropertyEditView'])->name('admin.pageProperty.edit');

    Route::post('/admin/sliderImage/add', [PropertyOperationController::class, 'AddSliderImage'])->name('admin.sliderImage.add.post');
    Route::get('/admin/sliderImage/delete/{id}', [PropertyOperationController::class, 'SliderImageDelete'])->name('admin.sliderImage.delete');

    Route::post('/admin/pageProperty/edit', [PropertyOperationController::class, 'PagePropertyEditPost'])->name('admin.pageProperty.edit.post');
    Route::post('/admin/pageProperty/first-tab/edit', [PropertyOperationController::class, 'PagePropertyFirstTabEditPost'])->name('admin.pageProperty.first-tab.edit.post');
    Route::post('/admin/pageProperty/second-tab/edit', [PropertyOperationController::class, 'PagePropertySecondTabEditPost'])->name('admin.pageProperty.second-tab.edit.post');
    Route::post('/admin/pageProperty/third-tab/edit', [PropertyOperationController::class, 'PagePropertyThirdTabEditPost'])->name('admin.pageProperty.third-tab.edit.post');

    Route::post('/admin/blogPost/add', [PropertyOperationController::class, 'AddBlogPost'])->name('admin.blogPost.add.post');
    Route::get('/admin/blogPost/delete/{id}', [PropertyOperationController::class, 'BlogPostDelete'])->name('admin.blogPost.delete');

});
////// End Admin Pages //////



////// User Pages //////
Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.index');

    Route::get('/user/profile', [UserController::class, 'UserProfileInfo'])->name('user.profileInfo');

    Route::post('/user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');

    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');

    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');


    ////Property Operation Routes Vaccination Status Dose////
    Route::get('/user/vaccine-registration', [UserController::class, 'VaccineRegistrationView'])->name('user.vaccine.registration');

    Route::post('/user/vaccine-registration', [UserController::class, 'VaccineRegistrationPost'])->name('user.vaccine.registration.post');

    Route::get('/user/vaccination-details/{id}', [UserController::class, 'VaccinationDetailsView'])->name('user.vaccination.details');


    ////////////////////Vaccine Operation Routes////////////////////
    Route::get('/user/vaccine_list', [UserController::class, 'VaccineList'])->name('user.vaccine_list');

    Route::get('/user/vaccineWise-registration/{id}', [UserController::class, 'VaccineWiseRegistrationView'])->name('user.vaccineWise.registration');


    // Notification Meassage ///////
    Route::get('/user/message/list', [UserController::class, 'MessageList'])->name('user.message.list');


});
////// End User Pages //////




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
