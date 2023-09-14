<?php

use Illuminate\Http\Request;
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

//Login API
Route::post('login', [App\Http\Controllers\API\LoginAPICtr::class, 'login']);
//Rule API
Route::get('getRules', [App\Http\Controllers\API\RuleAPICtr::class, 'getRules']);
//Tenant Profile API
Route::get('getTenantProfile', [App\Http\Controllers\API\TenantAPICtr::class, 'getTenantProfile']);
//Payment GCash
Route::get('getPayment', [App\Http\Controllers\API\PaymentAPICtr::class, 'getPayment'])->name('getPayment');
Route::get('gcashPaymentCheckoutAPI', [App\Http\Controllers\API\PaymentAPICtr::class, 'gcashPaymentCheckoutAPI'])->name('gcashPaymentCheckoutAPI');
Route::post('deletePayment', [App\Http\Controllers\API\PaymentAPICtr::class, 'deletePayment']);
//Payment History(Consideration)
Route::get('PaymentHistory', [App\Http\Controllers\API\PaymentHistoryAPICtr::class, 'PaymentHistory']);
//Forum
Route::get('getForum', [App\Http\Controllers\API\ForumAPICtr::class, 'getForum']);
Route::post('addForum', [App\Http\Controllers\API\ForumAPICtr::class, 'addForum']);
Route::post('updateForum', [App\Http\Controllers\API\ForumAPICtr::class, 'updateForum']);
Route::post('deleteForum', [App\Http\Controllers\API\ForumAPICtr::class, 'deleteForum']);
//Comment
Route::get('getComment', [App\Http\Controllers\API\ForumAPICtr::class, 'getComment']);
Route::post('addComment', [App\Http\Controllers\API\ForumAPICtr::class, 'addComment']);
Route::post('updateComment', [App\Http\Controllers\API\ForumAPICtr::class, 'updateComment']);
Route::post('deleteComment', [App\Http\Controllers\API\ForumAPICtr::class, 'deleteComment']);
