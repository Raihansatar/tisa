<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
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
    // return view('welcome');
    return view('index');
})->name('index');

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::get('/logout', [LoginController::class, 'logoutProcess'])->name('logout.process');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/datatable', [ProductController::class, 'index_datatable'])->name('product.index.datatable');

});
