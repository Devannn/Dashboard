<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UserController;

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
    // return view('home');
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return view('auth.login');
    }
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {
    // Homepage Route
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Inbox Route
    Route::get('/inbox', [InboxController::class, 'index']);

    // Slack Route
    Route::get('/slack', [HomeController::class, 'welcome']);

    // Tasks Routes
    Route::get('/to-do', [TaskController::class, 'index']);
    Route::post('/task', [TaskController::class, 'store']);
    Route::delete('/task/{task}', [TaskController::class, 'destroy']);

    // Login for Calendar
    Route::get('/signin', [AuthController::class, 'signin']);
    Route::get('/callback', [AuthController::class, 'callback']);
    Route::get('/signout', [AuthController::class, 'signout']);

    // Calendar Routes
    Route::get('/calendar-login', [CalendarController::class, 'login']);
    Route::get('/calendar', [CalendarController::class, 'calendar']);

    // New Calendar Event Routes
    Route::get('/calendar/new', [CalendarController::class, 'getNewEventForm']);
    Route::post('/calendar/new', [CalendarController::class, 'createNewEvent']);

    // Users Route
    Route::get('/users', [UsersController::class, 'index']);

    // My User Routes
    Route::get('/user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'update_avatar']);

    // Edit Personal Settings Routes
    Route::get('user/edit-personal', [UserController::class, 'editPersonal'])->name('edit-personal');
    Route::put('user/edit-personal', [UserController::class, 'updatePersonal'])->name('update-personal');

    // Edit Email Routes
    Route::get('user/edit-security', [UserController::class, 'editEmail'])->name('edit-email');
    Route::put('user/edit-security', [UserController::class, 'updateEmail'])->name('update-email');

    // Edit Password Routes
    Route::get('/user/edit-security', [UserController::class, 'changePassword'])->name('change-password');
    Route::post('/user/edit-security', [UserController::class, 'updatePassword'])->name('update-password');

    // Edit Address Settings Routes
    Route::get('user/edit-address', [UserController::class, 'editAddress'])->name('edit-address');
    Route::put('user/edit-address', [UserController::class, 'updateAddress'])->name('update-address');
});
