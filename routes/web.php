<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/{section}', fn (string $section) => redirect()->route('resources.index', $section))
    ->whereIn('section', ['kapal', 'tangkapan', 'monitoring', 'parkir', 'harga-ikan', 'cuaca'])
    ->name('section');

Route::prefix('data/{resource}')->name('resources.')->group(function (): void {
    Route::get('/', [ResourceController::class, 'index'])->name('index');
    Route::get('/create', [ResourceController::class, 'create'])->name('create');
    Route::post('/', [ResourceController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ResourceController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ResourceController::class, 'update'])->name('update');
    Route::delete('/{id}', [ResourceController::class, 'destroy'])->name('destroy');
});
