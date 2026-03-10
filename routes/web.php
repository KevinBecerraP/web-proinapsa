<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\WhatWeDoController;

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


Route::get('/', function () {return view('index');})->name('home');
Route::get('/sobre-nosotros', function () { return view('pages.about.About-us');})->name('about-us');

Route::get('/noticias', [NewsController::class, 'index'])->name('news.index');
Route::get('/noticias/{id}', [NewsController::class, 'show'])->name('news.show');

Route::get('/que-hacemos', [WhatWeDoController::class, 'index'])->name('what-we-do.index');

Route::get('/repositorio', [RepositoryController::class, 'index'])->name('repository.index');
Route::get('/repositorio/{slug}', [RepositoryController::class, 'show'])->name('repository.show');
