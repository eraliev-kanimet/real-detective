<?php

use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\PageController;
use Illuminate\Support\Facades\Route;

Route::post('form/callback', [FormController::class, 'callback'])->name('form.callback');

Route::post('rating/likes_or_dislikes', [FormController::class, 'ratingLikeOrDislikeUpdate'])
    ->name('rating.likes_or_dislikes');

Route::get('rating/views/{rating}', [FormController::class, 'ratingViewsUpdate'])
    ->name('rating.views');

Route::get('page/{page}', [PageController::class, 'page'])->name('page');

Route::get('categories', [PageController::class, 'categories'])->name('categories');
Route::get('services', [PageController::class, 'services'])->name('services');
Route::get('services/{subcategory:slug}', [PageController::class, 'service'])->name('service');
Route::get('articles', [PageController::class, 'articles'])->name('articles');
Route::get('articles/{article:slug}', [PageController::class, 'article'])->name('article');
Route::get('reviews', [PageController::class, 'reviews'])->name('reviews');
