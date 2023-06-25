<?php 

/*** Book Routes */

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'book'],function () {
    Route::post('upsert',[BookController::class,'upsertBook']);
    Route::post('delete/{book_id}',[BookController::class,'deleteBook']);

    Route::post('add/attributes',[BookController::class,'upsertBookAttributes']);
    Route::post('delete/attributes/{attribute_id}',[BookController::class,'deleteBookAttributes']);
    Route::get('get/attribute/{attribute_id}',[BookController::class,'getAttribute']);
});

/*** Customer Routes */
Route::group(['prefix' => 'customer'],function () {
    // Entity Routes
    Route::post('upsert',[CustomerController::class,'upsertCustomer']);
    Route::post('delete/{customer_id}',[CustomerController::class,'deleteCustomer']);
    Route::post('borrow',[CustomerController::class,'borrowBook']);

    // Entity Attributes Route
    Route::post('add/attributes',[CustomerController::class,'upsertCustomerAttributes']);
    Route::post('delete/attributes/{attribute_id}',[CustomerController::class,'deleteCustomerAttributes']);
    Route::get('get/attribute/{attribute_id}',[CustomerController::class,'getAttribute']);
});