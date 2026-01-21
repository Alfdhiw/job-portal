<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\LowonganController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/job/{job}', [PublicController::class, 'show'])->name('job.show');
Route::post('/job/{job}/apply', [PublicController::class, 'apply'])->name('job.apply');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'candidate') {
            return redirect()->route('home');
        }
        return redirect()->route('jobs.index');
    })->name('dashboard');

    // Admin Routes
    Route::middleware('admin')->group(function () {
        Route::resource('jobs', JobController::class);
        Route::get('/list', [JobController::class, 'list'])->name('jobs.list');
        Route::get('/company-profile', [EmployerController::class, 'edit'])->name('employer.edit');
        Route::post('/company-profile', [EmployerController::class, 'update'])->name('employer.update');
        Route::get('/candidate', [EmployerController::class, 'candidates'])->name('employer.candidates');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
