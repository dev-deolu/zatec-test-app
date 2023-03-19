<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUpController;


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

Route::get('/', [LoginController::class, 'index'])->name('welcome')->middleware('guest');
Route::resource('signup', SignUpController::class)->only(['index', 'store'])->names([
    'index' => 'signup',
    'store' => 'signup'
])->middleware('guest');
Route::resource('login', LoginController::class)->only(['index', 'store'])->names([
    'index' => 'login',
    'store' => 'login'
])->middleware('guest');

