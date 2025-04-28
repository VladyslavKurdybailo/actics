<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleSheetsController;


// Група маршрутів, захищених для авторизованих користувачів
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    // Створення акту (форма)
    Route::get('/acts/create', [ActController::class, 'createForm'])->name('acts.createForm');
    Route::post('/acts/create', [ActController::class, 'createAct'])->name('acts.create');

    // Перегляд акту
    Route::get('/acts/{id}', [ActController::class, 'show'])->name('acts.show');

    // Завантаження підписаного акту
    Route::post('/acts/{id}/upload-signed', [ActController::class, 'uploadSignedAct'])->name('acts.uploadSigned');

    // Список актів
    Route::get('/acts', [ActController::class, 'index'])->name('acts.index');

    // Дашборд
    Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


    Route::get('/import-acts', [GoogleSheetsController::class, 'generateActsFromGoogleSheets']);

    Route::get('/import', [GoogleSheetsController::class, 'showImportPage'])->name('acts.import');
    Route::post('/import', [GoogleSheetsController::class, 'generateActsFromGoogleSheets'])->name('acts.import.process');
});

// Тестовий маршрут для QR-коду
Route::get('/test-qr', [QrCodeController::class, 'testQrCode']);

require __DIR__.'/auth.php';
