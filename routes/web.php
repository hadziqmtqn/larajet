<?php

use App\Http\Controllers\TexteditorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('texteditor')->group(function () {
        Route::get('/', [TexteditorController::class, 'index'])->name('texteditor.index');
        Route::post('/store', [TexteditorController::class, 'store'])->name('texteditor.store');
        Route::get('/{texteditor:id}', [TexteditorController::class, 'edit'])->name('texteditor.edit');
        Route::put('/{texteditor:id}/update', [TexteditorController::class, 'update'])->name('texteditor.update');
    });
});
