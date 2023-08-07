<?php

use App\Http\Controllers\Api\FormController;
use Illuminate\Support\Facades\Route;

Route::post('form/callback', [FormController::class, 'callback'])->name('form.callback');

Route::post('rating/likes_or_dislikes', [FormController::class, 'ratingLikeOrDislikeUpdate'])
    ->name('rating.likes_or_dislikes');

Route::get('rating/views/{rating}', [FormController::class, 'ratingViewsUpdate'])
    ->name('rating.views');
