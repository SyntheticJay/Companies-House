<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Company\SearchController;
use App\Http\Controllers\Home\HomeController;

use Illuminate\Support\Facades\Route;

use Jay\CHouse\CompaniesHouse;

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
    return redirect()->route('login');
});

Route::prefix('auth')->group(function() {
    Route::get('register', [RegisterController::class, 'show'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.post');

    Route::get('login', [LoginController::class, 'show'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
});

Route::middleware(['auth'])->group(function() {
    Route::get('home', [HomeController::class, 'show'])->name('home');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('company')->group(function() {
        Route::post('search', [SearchController::class, 'search'])->name('company.search');
    });

    Route::get('test', function() {
        $c = new CompaniesHouse();

        return $c->hello();
    });
});