<?php

use App\Http\Controllers\SettingContoller;
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

/*** System Routes */
Route::post('system',[SettingContoller::class,'changeSystem']);

/*** Operator Routes */
Route::post('upsert/operator',[UserController::class,'upsertOperator']);
Route::post('delete/operator/{operator_id}',[UserController::class,'deleteOperator']);
Route::get('get/operator/{operator_id}',[UserController::class,'getOperator']);
Route::get('list/operator',[UserController::class,'filter']);

