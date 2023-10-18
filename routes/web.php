<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

//Route::get('/', function () {
//    return inertia('Admin/Index');
//});



Route::group([
    'prefix' => '/admin',
    'as' => 'admin.',
], function () {
    Route::get('/',[DashboardController::class,'home'])->name('dashboard');

});


Route::group([
    'prefix' => '/',
    'as' => 'auth.',
], function () {

    Route::get('', [LoginController::class, 'create'])->name('login.create');
    Route::post('login', [LoginController::class, 'login'])->name('login.store');
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.store');
    Route::delete('logout', [LoginController::class, 'logout'])->name('logout');

});
