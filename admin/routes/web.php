<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthController;
//use App\Http\Controllers\User\ArticleController;

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

Route::get('/', function () {
    return redirect('/login');
});
Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth','isAdmin']], function(){

    Route::group(['prefix' => 'articles'], function(){
        Route::get('/', [ArticleController::class, 'index'])->name('articles');
        Route::get('/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('/create', [ArticleController::class, 'store'])->name('articles.store');
        Route::get('/edit/{id}', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/update/{id}', [ArticleController::class, 'update'])->name('articles.update');
        Route::delete('/delete/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
        Route::get('/view/{id}', [ArticleController::class, 'view'])->name('articles.view');
    });

    Route::group(['prefix' => 'tags'], function(){
        Route::get('/', [TagController::class, 'index'])->name('tags');
        Route::post('/create', [TagController::class, 'store'])->name('tags.store');
        Route::put('/update/{id}', [TagController::class, 'update'])->name('tags.update');
        Route::delete('/delete/{id}', [TagController::class, 'destroy'])->name('tags.destroy');
    });

    Route::group(['prefix' => 'categories'], function(){
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::post('/create', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::patch('/profile/update', [AuthController::class, 'update'])->name('profile.update');
    Route::post('profile-image-update', [AuthController::class, 'updateImage'])->name('profile.image.update');

});

Route::group(['middleware' => ['auth','isUser']], function(){
    Route::get('/articles', [App\Http\Controllers\User\ArticleController::class, 'index'])->name('user.articles');
    Route::get('/articles/{slug}', [App\Http\Controllers\User\ArticleController::class, 'getArticleDetails'])->name('user.articles.details');
});
