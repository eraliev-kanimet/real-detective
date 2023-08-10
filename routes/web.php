<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'home'])->name('home');
Route::get('faq', [HomeController::class, 'faq'])->name('faq');
Route::get('reviews', [HomeController::class, 'reviews'])->name('reviews');
Route::get('contacts', [HomeController::class, 'contacts'])->name('contacts');

Route::get('blog/{article:slug}', [ArticleController::class, 'show'])->name('article');
Route::get('blog', [ArticleController::class, 'index'])->name('articles');

Route::get('services/{subcategory:slug}', [CategoryController::class, 'subcategory'])->name('subcategory');
Route::get('services', [CategoryController::class, 'index'])->name('categories');
Route::get('price', [CategoryController::class, 'price'])->name('price');

Route::get('sitemap', [PageController::class, 'sitemap'])->name('sitemap');
Route::get('cookies-policy', [PageController::class, 'cookiesPolicy'])->name('cookies-policy');
Route::get('privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');

Route::redirect('/login', '/admin/login', 301)->name('login');

Route::fallback([HomeController::class, 'not_found'])->name('not_found');
