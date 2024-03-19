<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\KlasemenController;
use App\Http\Controllers\PertandinganController;
use Illuminate\Support\Facades\Route;

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

// Klasemen
Route::redirect('/', '/klasemen');
Route::get('/klasemen', [KlasemenController::class, 'index'])->name('klasemen');

// Club
Route::get('/club', [ClubController::class, 'index'])->name('club');
Route::get('/club-create', [ClubController::class, 'create'])->name('create-club');
Route::post('/club-create', [ClubController::class, 'store'])->name('store-club');
Route::get('/club-edit/{id}', [ClubController::class, 'edit'])->name('edit-club');
Route::put('/club-edit/{id}', [ClubController::class, 'update'])->name('update-club');
Route::delete('/club-destroy/{id}', [ClubController::class, 'destroy'])->name('destroy-club');

// Pertandingan Single
Route::get('/pertandingan_single', [PertandinganController::class, 'index'])->name('pertandingan_single');
Route::post('/store_single', [PertandinganController::class, 'store'])->name('store-single');


Route::get('/getAvailableClubs', [PertandinganController::class, 'getAvailableClubs'])->name('getAvailableClubs');


// Pertandingan Single
Route::get('/pertandingan_multiple', [PertandinganController::class, 'index_multiple'])->name('pertandingan_multiple');
Route::post('/store_multiple', [PertandinganController::class, 'store_multiple'])->name('store-multiple');
