<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\CustomersController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/shops',[ShopController::class,'getShops']);
    Route::post('/shops',[ShopController::class,'addShop']);
    Route::put('/shops',[ShopController::class,'assignIncharge']);
    Route::post('/inventory',[InventoryController::class,'addInventory']);
    Route::post('/category',[CategoriesController::class,'addCategory']);
    Route::post('/staff',[ShopController::class,'addStaff']);
    Route::get('/staff',[ShopController::class,'getStaff']);
    Route::post('/customers',[CustomersController::class,'addCustomer']);
    Route::get('/customers',[CustomersController::class,'getCustomers']);
    Route::post('/logout',[AuthController::class,'logout']);

});
