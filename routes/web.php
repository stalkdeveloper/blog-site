<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ArticleController;
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

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

Route::get('/all-articles', [ArticleController::class, 'allArticles'])->name('getAllArticles');
Route::get('/create-articles', [ArticleController::class, 'createArticles'])->name('getCreateArticles');
Route::post('/store-articles', [ArticleController::class, 'storeArticles'])->name('getStoreArticles');