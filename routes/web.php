<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleController;
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

// Route::get('/all-articles', [ArticleController::class, 'allArticles'])->name('getAllArticles');
// Route::get('/create-articles', [ArticleController::class, 'createArticles'])->name('getCreateArticles');
// Route::post('/store-articles', [ArticleController::class, 'storeArticles'])->name('getStoreArticles');
// Route::get('/view-articles/{id}', [ArticleController::class, 'viewArticles'])->name('getViewArticles');
// Route::get('/edit-articles/{id}', [ArticleController::class, 'viewArticles'])->name('getEditArticles');
// Route::post('/update-articles', [ArticleController::class, 'updateArticles'])->name('getUpdateArticles');
// Route::get('/delete-articles/{id}', [ArticleController::class, 'deleteArticles'])->name('getDeleteArticles');


Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    Route::get('/all-articles', [ArticleController::class, 'allArticles'])->name('getAllArticles');
    Route::get('/create-articles', [ArticleController::class, 'createArticles'])->name('getCreateArticles');
    Route::post('/store-articles', [ArticleController::class, 'storeArticles'])->name('getStoreArticles');
    Route::get('/view-articles/{id}', [ArticleController::class, 'viewArticles'])->name('getViewArticles');
    Route::get('/edit-articles/{id}', [ArticleController::class, 'viewArticles'])->name('getEditArticles');
    Route::post('/update-articles', [ArticleController::class, 'updateArticles'])->name('getUpdateArticles');
    Route::get('/delete-articles/{id}', [ArticleController::class, 'deleteArticles'])->name('getDeleteArticles');

    /* For Category */
    Route::get('/all-categories', [CategoryController::class, 'allCategory'])->name('getAllCategory');
    Route::get('/create-categories', [CategoryController::class, 'createCategory'])->name('getCreateCategory');
    Route::post('/create-categories', [CategoryController::class, 'storeCategory'])->name('getStoreCategory');
    Route::get('/view-categories/{id}', [CategoryController::class, 'viewCategoryDetails'])->name('getViewCategoryDetails');
    Route::get('/edit-categories/{id}', [CategoryController::class, 'viewCategory'])->name('getViewCategory');
    Route::post('/update-categories', [CategoryController::class, 'updateCategory'])->name('getUpdateCategory');
    Route::get('/delete-categories/{id}', [CategoryController::class, 'deleteCategory'])->name('getDeleteCategory');

    /* For User Role */
    Route::get('/all-user-role', [RoleController::class, 'allUserRole'])->name('getAllUserRole');
    Route::get('/create-user-role', [RoleController::class, 'createUserRole'])->name('getCreateUserRole');
    Route::post('/store-user-role', [RoleController::class, 'storeUserRole'])->name('getStoreUserRole');
    Route::get('/edit-user/{id}', [RoleController::class, 'viewUserRole'])->name('getViewUserRole');
    Route::post('/update-user-role', [RoleController::class, 'updateUserRole'])->name('getUpdateUserRole');
    Route::get('/delete-user-role/{id}', [RoleController::class, 'deleteUserRole'])->name('getDeleteUserRole');
});
