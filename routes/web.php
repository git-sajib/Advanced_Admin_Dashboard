<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('page/{page_slug}', [FrontendController::class, 'index']);

Auth::routes();
/* Socialite Login Routes */
Route::group(['prefix' => 'logins', 'as' => 'login.'], function () {
    Route::get('/{provider}', [LoginController::class, 'redirectToProvider'])->name('provider');
    Route::get('/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('provider.callback');
});

/*Backend Routes*/
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Resource Routes
    Route::resource('/module', ModuleController::class);
    Route::resource('/permission', PermissionController::class);
    Route::resource('/role', RoleController::class);
    Route::resource('/page', PageController::class);
    Route::resource('/users', UserController::class);

    //Backup Routes
    Route::resource('/backup', BackupController::class)->only(['index', 'store', 'destroy']);
    Route::get('/backup/download/{file_name}', [BackupController::class, 'download'])->name('backup.download');

    // System Setting Management Routes
    Route::group(['as' => 'settings.', 'prefix' => 'settings'], function () {
        /* General Setting */
        Route::get('general', [SettingController::class, 'general'])->name('general');
        Route::post('general', [SettingController::class, 'generalUpdate'])->name('general.update');

        /* Appearance Setting */
        Route::get('appearance', [SettingController::class, 'appearance'])->name('appearance');
        Route::post('appearance', [SettingController::class, 'appearanceUpdate'])->name('appearance.update');

        /* Mail Setting */
        Route::get('mail', [SettingController::class, 'mailView'])->name('mail');
        Route::post('mail', [SettingController::class, 'mailUpdate'])->name('mail.update');

        /* Social Login Setting */
        Route::get('socialite', [SettingController::class, 'socialiteView'])->name('socialite');
        Route::post('socialite', [SettingController::class, 'socialiteUpdate'])->name('socialite.update');
    });


    // Active or Inactive Routes
    Route::get('check/user/is_active/{user_id}', [UserController::class, 'checkActive'])->name('user.is_active.ajax');
    Route::get('check/page/is_active/{page_id}', [PageController::class, 'checkActive'])->name('page.is_active.ajax');

    // Profile Management Routes
    Route::get('/update-profile', [ProfileController::class, 'getUpdateProfile'])->name('getupdate.profile');
    Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('postupdate.profile');
    Route::get('/update-password', [ProfileController::class, 'getUpdatePassword'])->name('getupdate.password');
    Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('postupdate.password');
});
