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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', [App\Http\Controllers\CustomAuthController::class,'attemptLogin']);

Route::get('/invoice/list/{type}', [App\Http\Controllers\InvoiceController::class, 'index']);

Route::put('/invoice/update/{id}', [App\Http\Controllers\InvoiceController::class, 'update']);
