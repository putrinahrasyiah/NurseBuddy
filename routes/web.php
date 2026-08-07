<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudyLibraryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('tasks', TaskController::class)->except('show');
    Route::get('/study-library', [StudyLibraryController::class, 'index'])->name('study-library.index');
    Route::get('/study-library/category/{studyCategory}', [StudyLibraryController::class, 'byCategory'])->name('study-library.by-category');
    Route::get('/study-library/material/{studyMaterial}', [StudyLibraryController::class, 'show'])->name('study-library.show');
    Route::patch('/study-library/material/{studyMaterial}/status', [StudyLibraryController::class, 'updateStatus'])->name('study-library.status');
});

require __DIR__.'/auth.php';
