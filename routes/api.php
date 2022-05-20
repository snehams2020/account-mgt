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
    Route::post('/update-payment-type', ['as' => 'update-payment-type', 'uses' => 'App\Http\Controllers\API\PaymentTypeController@update']);
    Route::post('/delete-payment-type',['as' => 'delete-payment-type', 'uses' => 'App\Http\Controllers\API\PaymentTypeController@destroy']);

    Route::get('get-expense-category', 'App\Http\Controllers\API\ExpenseCategoryController@index');
    Route::post('add-expense-category', 'App\Http\Controllers\API\ExpenseCategoryController@store');
    Route::post('/update-expense-category', ['as' => 'update-expense-category', 'uses' => 'App\Http\Controllers\API\ExpenseCategoryController@update']);
    Route::post('/delete-expense-category',['as' => 'delete-expense-category', 'uses' => 'App\Http\Controllers\API\ExpenseCategoryController@destroy']);

    Route::get('get-expense', 'App\Http\Controllers\API\ExpenseController@index');
    Route::post('add-expense', 'App\Http\Controllers\API\ExpenseController@store');
    Route::post('/update-expense', ['as' => 'update-expense', 'uses' => 'App\Http\Controllers\API\ExpenseController@update']);
    Route::post('/delete-expense',['as' => 'delete-expense', 'uses' => 'App\Http\Controllers\API\ExpenseController@destroy']);

    Route::get('get-income-category', 'App\Http\Controllers\API\IncomeCategoryController@index');
    Route::post('add-income-category', 'App\Http\Controllers\API\IncomeCategoryController@store');
    Route::post('/update-income-category', ['as' => 'update-income-category', 'uses' => 'App\Http\Controllers\API\IncomeCategoryController@update']);
    Route::post('/delete-income-category',['as' => 'delete-income-category', 'uses' => 'App\Http\Controllers\API\IncomeCategoryController@destroy']);

    Route::get('get-income', 'App\Http\Controllers\API\IncomeController@index');
    Route::post('add-income', 'App\Http\Controllers\API\IncomeController@store');
    Route::post('/update-income', ['as' => 'update-income', 'uses' => 'App\Http\Controllers\API\IncomeController@update']);
    Route::post('/delete-income',['as' => 'delete-income', 'uses' => 'App\Http\Controllers\API\IncomeController@destroy']);
   
    Route::get('get-expense-report', 'App\Http\Controllers\API\ReportController@getExpenseReport');
    Route::get('get-income-report', 'App\Http\Controllers\API\ReportController@getIncomeReport');
    Route::get('get-balance-sheet', 'App\Http\Controllers\API\ReportController@getBalanceSheet');


});