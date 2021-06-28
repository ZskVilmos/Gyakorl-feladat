<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'listRealEstate'] );

Route::get('/get-real-estate/{id}', [App\Http\Controllers\HomeController::class, 'getRealEstate'] );

Route::post('/update-real-estate', [App\Http\Controllers\HomeController::class, 'updateRealEstate'] );

Route::get('/delete-real-estate/{id}', [App\Http\Controllers\HomeController::class, 'deleteRealEstate'] );
