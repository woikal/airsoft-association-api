<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParseClubController;
use App\Http\Controllers\ExtractController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/neu', [DashboardController::class, 'create'])->name('dashboard.new');

Route::get('/clubs', [ClubController::class, 'index'])->name('club.index');
Route::get('/clubs/create', [ClubController::class, 'create'])->name('club.create');
Route::post('/clubs/store', [ClubController::class, 'store'])->name('club.store');
Route::resource('extract', ExtractController::class)->only('index', 'store', 'edit', 'update');

/* Route::resource('club', ClubController::class);

Route::get('/upload', [ParseClubController::class, 'form'])->name('parser.form');

Route::get('parse', ParseClubController::class)->name('parse');
Route::post('/parse', [ParseClubController::class, 'load'])->name('parser.load');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/
Auth::routes();

