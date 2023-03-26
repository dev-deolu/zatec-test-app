<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignUpController;
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

Route::get('/', [LoginController::class, 'index'])
    ->name('welcome')->middleware('guest');
Route::resource('signup', SignUpController::class)
    ->only(['index', 'store'])->names([
        'index' => 'signup',
        'store' => 'signup',
    ])->middleware('guest');
Route::resource('login', LoginController::class)
    ->only(['index', 'store'])->names([
        'index' => 'login',
        'store' => 'login',
    ])->middleware('guest');

Route::get('/google/login', [GoogleLoginController::class, 'index'])
    ->name('google.login')->middleware('guest');
Route::get('/google/redirect', [GoogleLoginController::class, 'store'])
    ->name('google.redirect')->middleware('guest');

Route::post('logout', [LogoutController::class, 'destroy'])
    ->name('logout')->middleware('auth');

Route::resource('profile', ProfileController::class)->only(['index', 'store'])
    ->names([
        'index' => 'profile',
        'store' => 'profile',
    ])->middleware('auth');
Route::resource('album', AlbumController::class)
    ->only(['index', 'show', 'store', 'destroy'])
    ->names([
        'index' => 'album',
        'show' => 'album.show',
        'store' => 'album.store',
        'destroy' => 'album.destroy',
    ])->middleware('auth');
Route::resource('artist', ArtistController::class)
    ->only(['index', 'show', 'store', 'destroy'])
    ->names([
        'index' => 'artist',
        'show' => 'artist.show',
        'store' => 'artist.store',
        'destroy' => 'artist.destroy',
    ])->middleware('auth');
