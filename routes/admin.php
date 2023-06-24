<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\InstractorController;
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
    Route::post('delete/{student_id}',[StudentController::class,'deleteStudent']);

    Route::post('add/attributes',[StudentController::class,'upsertStudentAttributes']);
    Route::post('delete/attributes/{attribute_id}',[StudentController::class,'deleteStudentAttributes']);
    Route::get('get/attribute/{attribute_id}',[StudentController::class,'getAttribute']);
});

/*** Instractor Routes */
Route::group(['prefix' => 'instractor'],function () {
    Route::post('upsert',[InstractorController::class,'upsertInstractor']);
    Route::post('delete/{instractor_id}',[InstractorController::class,'deleteInstractor']);

    Route::post('add/attributes',[InstractorController::class,'upsertInstractorAttributes']);
    Route::post('delete/attributes/{attribute_id}',[InstractorController::class,'deleteInstractorAttributes']);
    Route::get('get/attribute/{attribute_id}',[InstractorController::class,'getAttribute']);
});

/*** Course Routes */
Route::group(['prefix' => 'course'],function () {
    Route::post('upsert',[CourseController::class,'upsertCourse']);
    Route::post('delete/{course_id}',[CourseController::class,'deleteCourse']);
    Route::post('add/student',[CourseController::class,'addStudent']);

    Route::post('add/attributes',[CourseController::class,'upsertCourseAttributes']);
    Route::post('delete/attributes/{attribute_id}',[CourseController::class,'deleteCourseAttributes']);
    Route::get('get/attribute/{attribute_id}',[CourseController::class,'getAttribute']);
});

/*** Book Routes */
Route::group(['prefix' => 'book'],function () {
    Route::post('upsert',[BookController::class,'upsertBook']);
    Route::post('delete/{book_id}',[BookController::class,'deleteBook']);

    Route::post('add/attributes',[BookController::class,'upsertBookAttributes']);
    Route::post('delete/attributes/{attribute_id}',[BookController::class,'deleteBookAttributes']);
    Route::get('get/attribute/{attribute_id}',[BookController::class,'getAttribute']);
});

