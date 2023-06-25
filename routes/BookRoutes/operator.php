<?php

use App\Http\Controllers\Global\BookController;
use App\Http\Controllers\Global\CustomerController;
use Illuminate\Support\Facades\Route;

// Book Routes
Route::group(['prefix' => 'book'],function () {
    // Entity Routes
    Route::get('list',[BookController::class,'filter']);
    Route::get('get/{book_id}',[BookController::class,'getBook']);

    // Entity Attributes Routes
    Route::get('attributes/list',[BookController::class,'attributesList']);
    Route::post('attributes/fill',[BookController::class,'fillBookAttributes']);
});

// Customer Routes
Route::group(['prefix' => 'customer'],function () {
    // Entity Routes
    Route::get('list',[CustomerController::class,'filter']);
    Route::get('get/{customer_id}',[CustomerController::class,'getCustomer']);

    // Entity Attributes Routes
    Route::get('attributes/list',[CustomerController::class,'attributesList']);
    Route::post('attributes/fill',[CustomerController::class,'fillCustomerAttributes']);
});