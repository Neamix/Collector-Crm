<?php

use App\Http\Controllers\SettingContoller;
use App\Http\Controllers\Admin\StudentController;
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
Route::post('get/operator/{operator_id}',[UserController::class,'getOperator']);
Route::post('delete/operator/{operator_id}',[UserController::class,'deleteOperator']);

/*** Student Routes */
Route::group(['prefix' => 'student'],function () {
    Route::post('upsert',[StudentController::class,'upsertStudent']);
    Route::post('add/attributes',[StudentController::class,'upsertStudentAttributes']);
    Route::post('delete/attributes/{attribute_id}',[StudentController::class,'deleteStudentAttributes']);
    Route::get('get/attribute/{attribute_id}',[StudentController::class,'getAttribute']);
});

