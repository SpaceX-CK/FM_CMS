<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LivePage\LivePageController;

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

Auth::routes(['register' => false ]);
//group middleware auth and prefix 
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
// Route::group(['middleware' => 'auth'], function () {
    // product
    Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
    Route::resource('products', App\Http\Controllers\ProductController::class)->except(['show']);
    Route::get('/products/{product:slug}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/delete-image', [App\Http\Controllers\ProductController::class, 'deleteImage'])->name('products.delete-image');
    // category
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    Route::get('/categories/{category:slug}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/delete-image', [App\Http\Controllers\CategoryController::class, 'deleteImage'])->name('categories.delete-image');

    //article
    Route::resource('article', ArticleController::class);
    Route::post('article/editor/update', [ArticleController::class, 'editor'])->name('article-editor');
    Route::get('article/{article:slug}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::delete('article/{article:slug}/delete-image', [ArticleController::class, 'deleteImage'])->name('article.delete-image');
    // user
    Route::resource('user', UserController::class)->only('index', 'update');
    // shop
    Route::delete('/shops/delete-image', [App\Http\Controllers\ShopController::class, 'deleteImage'])->name('shops.delete-image');
    Route::resource('shops', App\Http\Controllers\ShopController::class)->except('create');
    // setting
    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings/update', [App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/delete-image', [App\Http\Controllers\SettingController::class, 'deleteImage'])->name('settings.delete-image');
    // home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
    Route::put('/home/update', [App\Http\Controllers\HomeController::class, 'update'])->name('home.update');
    Route::post('/home/delete-image', [App\Http\Controllers\HomeController::class, 'deleteImage'])->name('home.delete-image');
});

Route::prefix('/')->group(function () {
    Route::get('/', [App\Http\Controllers\LivePage\LivePageController::class, 'index'])->name('index');
    Route::get('/about', [App\Http\Controllers\LivePage\LivePageController::class, 'getAbout'])->name('about');
    Route::get('/terms-of-use', [App\Http\Controllers\LivePage\LivePageController::class, 'getTermOfUse'])->name('getTermOfUse');
    Route::get('/privacy-policy', [App\Http\Controllers\LivePage\LivePageController::class, 'getPrivacyPolicy'])->name('getPrivacyPolicy');
    Route::get('/categories', [App\Http\Controllers\LivePage\LivePageController::class, 'getCategories'])->name('getCategories');
    Route::get('/contact', [App\Http\Controllers\LivePage\LivePageController::class, 'getContact'])->name('getcontact');
    Route::post('/contact/form', [App\Http\Controllers\LivePage\LivePageController::class, 'email'])->name('form'); 
    Route::get('/article', [App\Http\Controllers\LivePage\LivePageController::class, 'getArticle'])->name('getarticle');
    Route::get('/article/{article:slug}', [App\Http\Controllers\LivePage\LivePageController::class, 'getArticles'])->name('getarticles');
    Route::get('/{category:slug}', [App\Http\Controllers\LivePage\LivePageController::class, 'getCategory'])->name('getCategory');
    Route::get('/{category:slug}/{product:slug}', [App\Http\Controllers\LivePage\LivePageController::class, 'getProduct'])->name('getProduct');
});


Route::fallback(function () {
    abort(404);
});
