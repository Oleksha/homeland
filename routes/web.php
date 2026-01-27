<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/vats'))->name('home');

// Справочники
Route::get('/directories', Controllers\DirectoryController::class)
    ->name('directories.index');

Route::resource('vats', Controllers\VatController::class)
    ->except(['show']);
Route::resource('contractor-types', Controllers\ContractorTypeController::class)
    ->except(['show']);

// Контрагенты
Route::get('contractors/archive', [Controllers\ContractorController::class, 'archive'])
    ->name('contractors.archive');
Route::post('contractors/{id}/restore', [Controllers\ContractorController::class, 'restore'])
    ->name('contractors.restore');
Route::delete('contractors/{id}/force-delete', [Controllers\ContractorController::class, 'forceDelete'])
    ->name('contractors.forceDelete');
Route::resource('contractors', Controllers\ContractorController::class);

// Поступления
Route::prefix('receipts')->group(function () {
    Route::get('/archive', [Controllers\ReceiptController::class, 'archive'])
        ->name('receipts.archive');
    Route::post('/{id}/restore', [Controllers\ReceiptController::class, 'restore'])
        ->name('receipts.restore');
    Route::delete('/{id}/force-delete', [Controllers\ReceiptController::class, 'forceDelete'])
        ->name('receipts.forceDelete');
});

Route::resource('receipts', Controllers\ReceiptController::class);
