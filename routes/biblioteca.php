<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\LlibreController;
use App\Http\Controllers\AutorController;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [DefaultController::class, 'home'])->name('home');

Route::get('/default/esborrarCookie', [DefaultController::class, 'esborrarCookie'])->name('default_esborrarCookie');

//// LLIBRES
Route::get('/llibre/list', [LlibreController::class, 'list'])->name('llibre_list');

Route::match(['get', 'post'], '/llibre/edit/{id}', [LlibreController::class, 'edit'])->name('llibre_edit')->middleware('auth');

Route::match(['get', 'post'], '/llibre/new', [LlibreController::class, 'new'])->name('llibre_new')->middleware('auth');

Route::get('/llibre/delete/{id}', [LlibreController::class, 'delete'])->name('llibre_delete')->middleware('auth');

//AUTORS
Route::get('/autor/list', [AutorController::class, 'list'])->name('autor_list');

Route::match(['get', 'post'], '/autor/edit/{id}', [AutorController::class, 'edit'])->name('autor_edit')->middleware('auth');

Route::match(['get', 'post'], '/autor/new', [AutorController::class, 'new'])->name('autor_new')->middleware('auth');

Route::get('/autor/delete/{id}', [AutorController::class, 'delete'])->name('autor_delete')->middleware('auth');

