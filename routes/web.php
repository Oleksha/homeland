<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/vats'))->name('home');

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

<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/vats'))->name('home');

Route::resource('vats', Controllers\VatController::class)
    ->except(['show']);
Route::resource('contractor-types', Controllers\ContractorTypeController::class)
    ->except(['show']);

