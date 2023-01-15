<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Search\SearchController;
use App\Http\Controllers\Company\CompanyController;

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

Route::get('/', function() {
    return redirect()->route('login');
});

Route::prefix('auth')->group(function() {
    Route::get('register', [RegisterController::class, 'show'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.post');

    Route::get('login', [LoginController::class, 'show'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
});

Route::get('search', [SearchController::class, 'index'])->name('search');
Route::post('search', [SearchController::class, 'search'])->name('search.handle');

Route::middleware(['auth'])->group(function() {
    Route::get('home', [HomeController::class, 'show'])->name('home');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('company')->group(function() {
        Route::get('{company_id}', [CompanyController::class, 'index'])->name('company');
        Route::get('{company_id}/officers', [CompanyController::class, 'officers'])->name('company.officers');
        Route::get('{company_id}/previous-names', [CompanyController::class, 'previousNames'])->name('company.previous-names');
        Route::get('{company_id}/filing-history', [CompanyController::class, 'filingHistory'])->name('company.filing-history');
        Route::get('{company_id}/accounts', [CompanyController::class, 'accounts'])->name('company.accounts');
        Route::get('{company_id}/notes', [CompanyController::class, 'notes'])->name('company.notes');
        Route::delete('{company_id}/notes/{note_id}', [CompanyController::class, 'deleteNote'])->name('company.notes.delete');
        Route::put('{company_id}/notes/{note_id}', [CompanyController::class, 'updateNote'])->name('company.notes.update');
    });
});
