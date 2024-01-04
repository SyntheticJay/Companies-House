<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Search\SearchController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Monitor\MonitorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('auth.login');
});

Route::group([
    'middleware' => ['guest'],
    'prefix'      => 'auth',
    'as'          => 'auth.'
], function () {
   Route::get('/', [LoginController::class, 'index'])->name('login');
   Route::post('/', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::group([
    'middleware' => ['auth']
], function () {
   Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
   Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

   Route::group([
       'prefix' => 'profile',
       'as'    => 'profile.'
   ], function () {
       Route::get('/', [ProfileController::class, 'index'])->name('index');
       Route::post('/', [ProfileController::class, 'update'])->name('update');
   });

   Route::group([
       'prefix' => 'search',
       'as'    => 'search.'
   ], function () {
       Route::get('/', [SearchController::class, 'index'])->name('index');
       Route::post('/', [SearchController::class, 'search'])->name('submit');
   });

   Route::group([
       'prefix' => 'companies',
         'as'    => 'companies.'
   ], function () {
       Route::get('/{companyNumber}', [CompanyController::class, 'index'])->name('index');
   });

   Route::group([
       'prefix' => 'monitor',
       'as'    => 'monitor.'
   ], function () {
      Route::get('/', [MonitorController::class, 'index'])->name('index');
   });
});
