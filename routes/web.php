<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\ExchangeController;
use \App\Http\Controllers\IndustryController;
use \App\Http\Controllers\StockController;

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
Auth::routes();
Route::get('/', [ExchangeController::class, 'index']);
Route::get('/exchanges/{exchange}/stocks', [StockController::class, "getStocksFromExchange"]);
Route::get('/exchanges/{exchange}/stocks/{stock}/info', [StockController::class, "getInfo"]);
Route::get('/sector/{sector}/industries', [IndustryController::class, "getIndustriesFromSector"]);
Route::get('/sector/{sector}/industries/{industry}/stocks', [StockController::class, "getStocksFromIndustry"]);
Route::get('/sector/{sector}/industries/{industry}/stocks/info', [StockController::class, "getInfo"]);
