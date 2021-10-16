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

// itt jelennek meg a feltöltött házak
Route::get('/', [App\Http\Controllers\HomeController::class, 'listRealEstate'] );


// készítés menűje
Route::get('/create-real-estate', [App\Http\Controllers\HomeController::class, 'createRealEstateMenu'] );

// új ház feltöltése
Route::POST('/creating-real-estate', [App\Http\Controllers\HomeController::class, 'createRealEstate'] );

// itt nézhetjük meg az eggyes házak részleteit
Route::get('/get-real-estate/{id}', [App\Http\Controllers\HomeController::class, 'getRealEstate'] );

// az aktuális ház adatait itt lehet átírni
Route::get('/update-real-estate/{id}', [App\Http\Controllers\HomeController::class, 'updateRealEstateMenu'] );

// az aktuális ház átírt adatait itt tölti fel az adatbázisban
Route::post('/update-real-estate', [App\Http\Controllers\HomeController::class, 'updateRealEstate'] );

// ezzel lehet törölni az aktuális házat
Route::get('/delete-real-estate/{id}', [App\Http\Controllers\HomeController::class, 'deleteRealEstate'] );

// itt lehet majd választani a típus közül, ebben a controllerben leghátra kell rakni,
// mert ha előrébb raknám, akkor lenne olyan veblap ami nem működne
Route::POST('/list-Real-Estate-In-Type', [App\Http\Controllers\HomeController::class, 'listRealEstateInType'] );

