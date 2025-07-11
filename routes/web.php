<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtractUploadController;
use App\Http\Controllers\ParseTeamController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Auth;
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

/* DE routes */
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/neu', [DashboardController::class, 'create'])->name('dashboard.new');

Route::resource('extract', ExtractUploadController::class)->only('index', 'store', 'edit', 'update');
Route::get('parse', ParseTeamController::class)->name('parse');

Route::resource('club', TeamController::class);

Route::get('/upload', [ParseTeamController::class, 'form'])->name('parser.form');
Route::post('/parse', [ParseTeamController::class, 'load'])->name('parser.load');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/parse', [ParseTeamController::class, 'load'])->name('parser.load');
Auth::routes();

