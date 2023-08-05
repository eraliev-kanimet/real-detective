<?php

use App\Http\Controllers\Api\FormController;
use Illuminate\Support\Facades\Route;

Route::post('form/callback', [FormController::class, 'callback'])->name('form.callback');
