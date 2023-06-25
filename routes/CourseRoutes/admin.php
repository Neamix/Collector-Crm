<?php 
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\InstractorController;
use App\Http\Controllers\Admin\StudentController;
use Illuminate\Support\Facades\Route;

/*** Student Routes */
Route::group(['prefix' => 'student'],function () {
    // Entity Routes 
    Route::post('upsert',[StudentController::class,'upsertStudent']);
    Route::post('delete/{student_id}',[StudentController::class,'deleteStudent']);

    // Entity Attributes Route
    Route::post('add/attributes',[StudentController::class,'upsertStudentAttributes']);
    Route::post('delete/attributes/{attribute_id}',[StudentController::class,'deleteStudentAttributes']);
    Route::get('get/attribute/{attribute_id}',[StudentController::class,'getAttribute']);
});

/*** Instractor Routes */
Route::group(['prefix' => 'instractor'],function () {
    // Entity Routes 
    Route::post('upsert',[InstractorController::class,'upsertInstractor']);
    Route::post('delete/{instractor_id}',[InstractorController::class,'deleteInstractor']);

    // Entity Attributes Route
    Route::post('add/attributes',[InstractorController::class,'upsertInstractorAttributes']);
    Route::post('delete/attributes/{attribute_id}',[InstractorController::class,'deleteInstractorAttributes']);
    Route::get('get/attribute/{attribute_id}',[InstractorController::class,'getAttribute']);
});

/*** Course Routes */
Route::group(['prefix' => 'course'],function () {
    // Entity Routes 
    Route::post('upsert',[CourseController::class,'upsertCourse']);
    Route::post('delete/{course_id}',[CourseController::class,'deleteCourse']);
    Route::post('add/student',[CourseController::class,'addStudent']);

    // Entity Attributes Route
    Route::post('add/attributes',[CourseController::class,'upsertCourseAttributes']);
    Route::post('delete/attributes/{attribute_id}',[CourseController::class,'deleteCourseAttributes']);
    Route::get('get/attribute/{attribute_id}',[CourseController::class,'getAttribute']);
});