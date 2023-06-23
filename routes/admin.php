<?php

use App\Http\Controllers\UserController;
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


/*** Operator Routes */
Route::post('upsert/operator',[UserController::class,'upsertOperator']);
Route::post('get/operator/{operator_id}',[UserController::class,'getOperator']);
Route::post('delete/operator/{operator_id}',[UserController::class,'deleteOperator']);
