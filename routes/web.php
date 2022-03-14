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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('pendaftar', [App\Http\Controllers\pendaftarController::class, 'json']);
Route::get('pendaftar', [App\Http\Controllers\pendaftarController::class, 'index']);
Route::post('pendaftar/store', [App\Http\Controllers\pendaftarController::class, 'store']);
Route::get('pendaftar/{id}/edit', [App\Http\Controllers\pendaftarController::class, 'edit']);
Route::delete('pendaftar/delete/{id}', [App\Http\Controllers\pendaftarController::class, 'destroy']);
