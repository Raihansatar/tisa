<?php

use App\Http\Controllers\DebtController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    
});

    Route::get('/datatable', [DebtController::class, 'debtDatatable'])->name('debt.ajax.datatable');
    Route::get('/getTotalDebt', [DebtController::class, 'getTotalDebt'])->name('debt.ajax.getTotalDebt');
    Route::post('/createDebt', [DebtController::class, 'createDebt'])->name('debt.ajax.createDebt');
    Route::post('/payDebt', [DebtController::class, 'payDebt'])->name('debt.ajax.payDebt');
    Route::post('/payOneDebt', [DebtController::class, 'payOneDebt'])->name('debt.ajax.payOneDebt');
    Route::get('/getAllDebt', [DebtController::class, 'getAllDebt'])->name('debt.getAll');
