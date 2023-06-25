<?php

use App\Http\Controllers\Global\BookController;
use App\Http\Controllers\Global\CourseController;
use App\Http\Controllers\Global\CustomerController;
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