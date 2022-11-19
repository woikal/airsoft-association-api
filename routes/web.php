<?php

use App\Http\Controllers\ParseController;
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

Route::get('/form', [ParseController::class, 'form'])->name('parser.form');
Route::post('/parse', [ParseController::class, 'parse'])->name('parser.parse');
