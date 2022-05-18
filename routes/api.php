<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PassportAuthController;
use App\Http\Controllers\API\PaymentTypeController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
  
Route::middleware('auth:api')->group(function () {
    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
    Route::get('get-payment-type', 'App\Http\Controllers\API\PaymentTypeController@getPaymentType');
    Route::post('add-payment-type', 'App\Http\Controllers\API\PaymentTypeController@store');
    Route::post('/update-payment-type/{id}', ['as' => 'update-payment-type', 'uses' => 'App\Http\Controllers\API\PaymentTypeController@update']);
    Route::post('/delete-payment-type/{id}',['as' => 'delete-payment-type', 'uses' => 'App\Http\Controllers\API\PaymentTypeController@destroy']);

    Route::get('get-expense-category', 'App\Http\Controllers\API\ExpenseCategoryController@index');
    Route::post('add-expense-category', 'App\Http\Controllers\API\ExpenseCategoryController@store');
    Route::post('/update-expense-category/{id}', ['as' => 'update-expense-category', 'uses' => 'App\Http\Controllers\API\ExpenseCategoryController@update']);
    Route::post('/delete-expense-category/{id}',['as' => 'delete-expense-category', 'uses' => 'App\Http\Controllers\API\ExpenseCategoryController@destroy']);

    Route::get('get-expense', 'App\Http\Controllers\API\ExpenseController@index');
    Route::post('add-expense', 'App\Http\Controllers\API\ExpenseController@store');
    Route::post('/update-expense/{id}', ['as' => 'update-expense', 'uses' => 'App\Http\Controllers\API\ExpenseController@update']);
    Route::post('/delete-expense/{id}',['as' => 'delete-expense', 'uses' => 'App\Http\Controllers\API\ExpenseController@destroy']);

});