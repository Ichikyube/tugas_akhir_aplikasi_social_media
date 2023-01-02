<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
Route::get('/', function() {
    return view('welcome');
})->name('welcome');

Route::prefix('/profile')
    ->name('profile.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/create', [ProfileController::class, 'create'])->name('create');
        Route::post('/store', [ProfileController::class, 'store'])->name('store');
        Route::get('/dashboard', [ProfileController::class, 'getDashboard'])->name('dashboard');
});

Route::middleware('guest')->group(function () {

    Route::post('/signup', [UserController::class, 'postSignUp'])->name('signup');
    Route::post('/signin', [UserController::class, 'postSignIn'])->name('signin');
});
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
});


Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/bycreator', [App\Http\Controllers\HomeController::class, 'index'])->name('ShowCreators');
Route::get('/byseries', [App\Http\Controllers\HomeController::class, 'index'])->name('ShowSeries');

