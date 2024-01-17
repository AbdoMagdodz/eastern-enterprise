<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect('companies');
});

Auth::routes();

Route::get('companies', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
Route::group(
    ['middleware' => 'auth', 'prefix' => 'companies'],
    function () {
        Route::get('create', [App\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
        Route::post('/', [App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
    }
);
