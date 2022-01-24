<?php

use App\Http\Controllers\Api\CartController;
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

Route::post('/cart/calculate', [CartController::class, 'calculate']);
Route::post('/cart/external', [CartController::class, 'external']);

