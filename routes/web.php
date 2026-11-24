<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/about', 'tasks.about')->name('about');
Route::view('/profile', 'profile.public')->name('profile.public');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/{task}', [TaskController::class, 'show'])->whereNumber('task')->name('tasks.show');

Route::redirect('/dashboard', '/tasks')->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/tasks/archived', [TaskController::class, 'archived'])->name('tasks.archived');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->whereNumber('task')->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->whereNumber('task')->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->whereNumber('task')->name('tasks.destroy');
    Route::delete('/tasks/{task}/delete', [TaskController::class, 'destroyPermanently'])->whereNumber('task')->name('tasks.delete');

    Route::get('/account/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/account/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/account/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
