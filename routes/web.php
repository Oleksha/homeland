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
Route::prefix('receipts')
    ->name('receipts.')
    ->controller(Controllers\ReceiptController::class)
    ->group(function () {
        Route::get('archive', 'archive')->name('archive');
        Route::post('{id}/restore', 'restore')->name('restore');
        Route::delete('{id}/force-delete', 'forceDelete')->name('forceDelete');
});

Route::resource('receipts', Controllers\ReceiptController::class);

// Статьи расхода
Route::prefix('expense-items')
    ->name('expense-items.')
    ->controller(Controllers\ExpenseItemController::class)
    ->group(function () {

        Route::get('archive', 'archive')->name('archive');
        Route::post('{id}/restore', 'restore')->name('restore');
        Route::delete('{id}/force', 'forceDelete')->name('force');

    });

Route::resource('expense-items', Controllers\ExpenseItemController::class)
    ->except('show');

// Бюджет
Route::prefix('budgets')
    ->name('budgets.')
    ->controller(Controllers\BudgetController::class)
    ->group(function () {

        Route::get('archive', 'archive')->name('archive');
        Route::post('{id}/restore', 'restore')->name('restore');
        Route::delete('{id}/force', 'forceDelete')->name('force');

    });

Route::prefix('budgets')->name('budgets.')->group(function () {
    Route::post('import', Controllers\ImportBudgetController::class)->name('import');
    //Route::get('import/template', Controllers\BudgetImportTemplateController::class)
    //    ->name('import.template');
});

Route::resource('budgets', Controllers\BudgetController::class);
