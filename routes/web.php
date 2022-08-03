<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\PageControllers\UserPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware','auth'], function(){
    /*
    | public route for authenticated users
    | this will be the routes that are accessible to all users
    */
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
    Route::get('/redirectAuthenticatedUser', [RedirectAuthenticatedUsersController::class,'redirectToHome']);

    /*
    | grouped routes per user role
    | group protected routes that is only accessble by the matching role
    */
    Route::group(['middleware','checkRole:admin'], function(){
        Route::inertia('/admin/dashboard', 'AdminDashboard')->name('testAdmin');
    });

    Route::group(['middleware','checkRole:user'], function(){
        Route::get('/user/dashboard',[UserPageController::class,'index'])->name('userDashboard');
        Route::get('/user/test_page',[UserPageController::class,'test'])->name('userTestPage');
    });

    Route::group(['middleware','checkRole:guest'], function(){
        Route::inertia('/guest/dashboard', 'GuestDashboard')->name('testGuest');
    });
});

require __DIR__.'/auth.php';
