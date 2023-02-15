<?php

use App\Http\Controllers\API\BankDetailController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\EmployeeTransferController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\OrderWagonPlaceController;
use App\Http\Controllers\API\RouteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('/bank_detail', BankDetailController::class);
Route::apiResource('/city', CityController::class);
Route::apiResource('/client', ClientController::class);
Route::apiResource('/employee', EmployeeController::class);
Route::apiResource('/employee_transfer', EmployeeTransferController::class);
Route::apiResource('/job', JobController::class);
Route::apiResource('/order', OrderController::class);
Route::apiResource('/order_wagon_place', OrderWagonPlaceController::class);
Route::apiResource('/route', RouteController::class);
