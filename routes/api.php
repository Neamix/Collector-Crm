<?php

use App\Http\Controllers\Global\CourseController;
use App\Http\Controllers\Global\InstractorController;
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
        Route::get('get/{student_id}',[StudentController::class,'getStudent']);

        Route::get('attributes/list',[StudentController::class,'attributesList']);
        Route::post('attributes/fill',[StudentController::class,'fillStudentAttributes']);
    });

    // Instractor Routes
    Route::group(['prefix' => 'instractor'],function () {
        Route::get('list',[InstractorController::class,'filter']);
        Route::get('get/{instractor_id}',[InstractorController::class,'getInstractor']);

        Route::get('attributes/list',[InstractorController::class,'attributesList']);
        Route::post('attributes/fill',[InstractorController::class,'fillInstractorAttributes']);
    });

    // Course Routes
    Route::group(['prefix' => 'course'],function () {
        Route::get('list',[CourseController::class,'filter']);
        Route::get('get/{course_id}',[CourseController::class,'getCourse']);

        Route::get('attributes/list',[CourseController::class,'attributesList']);
        Route::post('attributes/fill',[CourseController::class,'fillCourseAttributes']);
    });
    
});
