<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\WhatWeDoController;
use App\Http\Controllers\EducationCommunicationController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\SocialProjectionController;
use App\Http\Controllers\FormalEducationController;
use App\Http\Controllers\EducationalMaterialsController;
use App\Http\Controllers\NonFormalEducationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sobre-nosotros', [AboutController::class, 'index'])->name('about-us');
Route::get('/sobre-nosotros/equipo/{slug}', [TeamMemberController::class, 'show'])->name('team.show');

Route::get('/noticias', [NewsController::class, 'index'])->name('news.index');
Route::get('/noticias/{id}', [NewsController::class, 'show'])->name('news.show');

Route::get('/que-hacemos', [WhatWeDoController::class, 'index'])->name('what-we-do.index');
Route::get('/que-hacemos/educacion-comunicacion', [EducationCommunicationController::class, 'index'])->name('area.educacion-comunicacion');
Route::get('/que-hacemos/educacion-comunicacion/educacion-formal', [FormalEducationController::class, 'index'])->name('area.educacion-formal');
Route::get('/que-hacemos/educacion-comunicacion/educacion-no-formal', [NonFormalEducationController::class, 'index'])->name('area.educacion-no-formal');
Route::get('/que-hacemos/educacion-comunicacion/educacion-no-formal/{slug}', [CourseController::class, 'show'])->name('course.show');
Route::get('/que-hacemos/educacion-comunicacion/materiales', [EducationalMaterialsController::class, 'index'])->name('area.materiales-educacion');
Route::get('/que-hacemos/investigacion', [ResearchController::class, 'index'])->name('area.investigacion');
Route::get('/que-hacemos/proyeccion-social', [SocialProjectionController::class, 'index'])->name('area.proyeccion-social');

Route::get('/contactanos', [ContactController::class, 'index'])->name('contact.index');

Route::get('/repositorio', [RepositoryController::class, 'index'])->name('repository.index');
Route::get('/repositorio/{slug}', [RepositoryController::class, 'show'])->name('repository.show');
