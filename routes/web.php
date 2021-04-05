<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryItemController;
use App\Http\Controllers\EmployeeController;


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

// Get Methods

Route::get('/', [AuthController::class, 'sign_in'])->middleware('guest');

Route::get('transformers', [FrontendController::class, 'transformers']);

Route::get('sign-in', [AuthController::class, 'sign_in'])->name('login')->middleware('guest');

Route::get('sign-up', [AuthController::class, 'sign_up'])->name('sign-up')->middleware('guest');

Route::get('sign-out', [AuthController::class, 'signout'])->middleware('auth');

Route::get('dashboard', [AdminController::class, 'index'])->middleware('admin');

Route::get('profile', [AdminController::class, 'profile'])->middleware('admin');

Route::get('useractivation/{token}', [AdminController::class, 'user_activation'])->middleware('guest');

Route::get('forgot-password', [AdminController::class, 'forgot_password'])->middleware('guest');

Route::get('resetpassword', [AdminController::class, 'resetpassword'])->middleware('guest');

// Post Methods

Route::post('sign-in', [AuthController::class, 'authenticate'])->middleware('guest');

Route::post('sign-up', [AuthController::class, 'register'])->middleware('guest');


// Match Method

Route::match(['get', 'post'], 'change-password', [AdminController::class, 'change_password'])->middleware('admin');

Route::match(['get', 'post'], 'update-profile', [AdminController::class, 'update_profile'])->middleware('admin');

Route::match(['get', 'post'], 'passwordsetting', [AdminController::class, 'passwordsetting'])->middleware('guest');

Route::match(['get', 'post'], 'forgot_password', [AdminController::class, 'forgot_password'])->middleware('guest');

Route::match(['get', 'post'], 'entry-form/{id?}', [AdminController::class, 'entry_form'])->middleware('admin');

Route::match(['get', 'post'], 'entry-form-save/{id?}', [AdminController::class, 'entry_form_save'])->middleware('admin');

Route::match(['get', 'post'], 'exit-form/{id?}', [AdminController::class, 'exit_form'])->middleware('admin');

Route::match(['get', 'post'], 'exit-form-save/{id?}', [AdminController::class, 'exit_form_save'])->middleware('admin');
Route::match(['get', 'post'], 'entry-form-email/{id?}', [AdminController::class, 'entry_form_email'])->middleware('admin');
Route::resource('user', UserController::class)->middleware('admin');
Route::resource('category', CategoryController::class)->middleware('admin');
Route::resource('category.item', CategoryItemController::class)->middleware('admin');
Route::resource('employee', EmployeeController::class)->middleware('admin');
