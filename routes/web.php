<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;

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

Route::get('/', [DashboardController::class, 'index']);
Route::get('/manage', [DashboardController::class, 'manage']);

Route::get('/city', [DashboardController::class, 'getAllCity']);
Route::get('/province', [DashboardController::class, 'getAllProvince']);

Route::get('/map', [DashboardController::class, 'getGeo']);
Route::get('/article/{article}', [ArticleController::class, 'show']);
Route::get('/article', [ArticleController::class, 'index']);
Route::delete('/article/{article}', [ArticleController::class, 'destroy']);
Route::put('/article/{article}', [ArticleController::class, 'update']);
Route::post('/article', [ArticleController::class, 'store']);