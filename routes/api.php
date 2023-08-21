<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// rota teste
Route::get('/teste', function () {
    return response()->json(['message' => 'Hello World!'], 200);
});

Route::get('/cliente', 'App\Http\Controllers\ClienteController@index');
Route::get('/cliente/{id}', 'App\Http\Controllers\ClienteController@show');
Route::post('/cliente', 'App\Http\Controllers\ClienteController@store')->name('clientes.store.api');
Route::put('/cliente/{id}', 'App\Http\Controllers\ClienteController@update');
Route::delete('/cliente/{id}', 'App\Http\Controllers\ClienteController@destroy');
