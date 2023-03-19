<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
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
Route::post('logout', [LogoutController::class, 'destroy'])->name('logout');
Route::resource('profile', ProfileController::class)->only(['index', 'store'])->names([
    'index' => 'profile',
    'store' => 'profile'
])->middleware('auth');
Route::resource('album', AlbumController::class)->only(['index', 'store'])->names([
    'index' => 'album',
    'store' => 'album'
])->middleware('auth');
Route::resource('artist', ArtistController::class)->only(['index', 'store'])->names([
    'index' => 'artist',
    'store' => 'artist'
])->middleware('auth');
