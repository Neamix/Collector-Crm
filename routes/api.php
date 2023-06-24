<?php

use App\Http\Controllers\Global\StudentController;
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

Route::post('login',[UserController::class,'login']);

// Global Authed Routes 
Route::group(['middleware' => 'auth'],function () {

    // Students Routes 
    Route::group(['prefix' => 'student'],function () {
        Route::get('list',[StudentController::class,'filter']);
        Route::get('attributes/list',[StudentController::class,'attributesList']);
        Route::post('attributes/fill',[StudentController::class,'fillStudentAttributes']);
    });

    
});
