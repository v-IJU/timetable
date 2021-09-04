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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/Submit',[App\Http\Controllers\HomeController::class, 'submit'])->name('submit');
Route::get('/Subjectform/{id}',[App\Http\Controllers\HomeController::class, 'subjectform'])->name('subjectform');
Route::get('/Timetable/{id}',[App\Http\Controllers\HomeController::class, 'table'])->name('table');

Route::post('/GenerateTable',[App\Http\Controllers\HomeController::class, 'generate'])->name('generate');
