<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/vats'))->name('home');

Route::resource('vats', Controllers\VatController::class)
    ->except(['show']);
