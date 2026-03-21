<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\WhatWeDoController;
use App\Http\Controllers\EducationCommunicationController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\SocialProjectionController;
use App\Http\Controllers\FormalEducationController;
use App\Http\Controllers\NonFormalEducationController;

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
Route::get('/que-hacemos/educacion-comunicacion', [EducationCommunicationController::class, 'index'])->name('area.educacion-comunicacion');
Route::get('/que-hacemos/educacion-comunicacion/educacion-formal', [FormalEducationController::class, 'index'])->name('area.educacion-formal');
Route::get('/que-hacemos/educacion-comunicacion/educacion-no-formal', [NonFormalEducationController::class, 'index'])->name('area.educacion-no-formal');
Route::get('/que-hacemos/investigacion', [ResearchController::class, 'index'])->name('area.investigacion');
Route::get('/que-hacemos/proyeccion-social', [SocialProjectionController::class, 'index'])->name('area.proyeccion-social');

Route::get('/repositorio', [RepositoryController::class, 'index'])->name('repository.index');
Route::get('/repositorio/{slug}', [RepositoryController::class, 'show'])->name('repository.show');
