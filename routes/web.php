<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
// route to show the login form
Route::get('login', [App\Http\Controllers\CustomAuthController::class, 'showLogin']);

Route::post('login', [App\Http\Controllers\CustomAuthController::class, 'attemptLogin'])->name('login');
Route::post('logout', [App\Http\Controllers\CustomAuthController::class, 'logout'])->name('logout');

Route::get('/menu', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/invoice/list/{type}', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice.index');
Route::get('/invoice/detail/{id}', [App\Http\Controllers\InvoiceController::class, 'show'])->name('invoice.detail');
Route::get('/invoice/update/{id}', [App\Http\Controllers\InvoiceController::class, 'update'])->name('invoice.update');
