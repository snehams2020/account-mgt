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
    Route::get('get-an-payment-type', 'App\Http\Controllers\API\PaymentTypeController@show');

    Route::post('add-payment-type', 'App\Http\Controllers\API\PaymentTypeController@store');
    Route::put('/update-payment-type', ['as' => 'update-payment-type', 'uses' => 'App\Http\Controllers\API\PaymentTypeController@update']);
    Route::delete('/delete-payment-type',['as' => 'delete-payment-type', 'uses' => 'App\Http\Controllers\API\PaymentTypeController@destroy']);

    Route::get('get-expense-category', 'App\Http\Controllers\API\ExpenseCategoryController@index');
    Route::get('get-an-expense-category', 'App\Http\Controllers\API\ExpenseCategoryController@show');
     Route::post('add-expense-category', 'App\Http\Controllers\API\ExpenseCategoryController@store');
    Route::put('/update-expense-category', ['as' => 'update-expense-category', 'uses' => 'App\Http\Controllers\API\ExpenseCategoryController@update']);
    Route::delete('/delete-expense-category',['as' => 'delete-expense-category', 'uses' => 'App\Http\Controllers\API\ExpenseCategoryController@destroy']);

    Route::get('get-expense', 'App\Http\Controllers\API\ExpenseController@index');
    Route::post('add-expense', 'App\Http\Controllers\API\ExpenseController@store');
    Route::get('get-an-expense', 'App\Http\Controllers\API\ExpenseController@show');

    Route::put('/update-expense', ['as' => 'update-expense', 'uses' => 'App\Http\Controllers\API\ExpenseController@update']);
    Route::delete('/delete-expense',['as' => 'delete-expense', 'uses' => 'App\Http\Controllers\API\ExpenseController@destroy']);

    Route::get('get-income-category', 'App\Http\Controllers\API\IncomeCategoryController@index');
    Route::get('get-an-income-category', 'App\Http\Controllers\API\IncomeCategoryController@show');

    Route::post('add-income-category', 'App\Http\Controllers\API\IncomeCategoryController@store');
    Route::put('/update-income-category', ['as' => 'update-income-category', 'uses' => 'App\Http\Controllers\API\IncomeCategoryController@update']);
    Route::delete('/delete-income-category',['as' => 'delete-income-category', 'uses' => 'App\Http\Controllers\API\IncomeCategoryController@destroy']);

    Route::get('get-income', 'App\Http\Controllers\API\IncomeController@index');
    Route::post('add-income', 'App\Http\Controllers\API\IncomeController@store');
    Route::get('get-an-income', 'App\Http\Controllers\API\IncomeController@show');

    Route::put('/update-income', ['as' => 'update-income', 'uses' => 'App\Http\Controllers\API\IncomeController@update']);
    Route::delete('/delete-income',['as' => 'delete-income', 'uses' => 'App\Http\Controllers\API\IncomeController@destroy']);
   
    Route::get('get-expense-report', 'App\Http\Controllers\API\ReportController@getExpenseReport');
    Route::get('get-income-report', 'App\Http\Controllers\API\ReportController@getIncomeReport');
    Route::get('get-balance-sheet', 'App\Http\Controllers\API\ReportController@getBalanceSheet');


});