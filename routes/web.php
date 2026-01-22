<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\Auth\EmployerRegisterController;
use App\Http\Controllers\CandidateProfileController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/job/{job}', [PublicController::class, 'show'])->name('job.show');
Route::get('/lowongan', [PublicController::class, 'search'])->name('public.jobs');
Route::post('/job/{job}/apply', [PublicController::class, 'apply'])->name('job.apply');
Route::get('/lamaran/{id}/konfirmasi', [PublicController::class, 'confirmInterview'])->name('email.confirmed');
Route::get('register/employer', [EmployerRegisterController::class, 'create'])->name('register.employer');
Route::post('register/employer', [EmployerRegisterController::class, 'store']);

// Protected Routes
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [JobController::class, 'index'])->name('dashboard');

    // ROUTE KHUSUS EMPLOYER
    Route::middleware('admin')->group(function () {
        Route::resource('jobs', JobController::class);
        Route::get('/list', [JobController::class, 'list'])->name('jobs.list');
        Route::get('/company-profile', [EmployerController::class, 'edit'])->name('employer.edit');
        Route::post('/company-profile', [EmployerController::class, 'update'])->name('employer.update');
        Route::get('/candidate', [EmployerController::class, 'candidates'])->name('employer.candidates');
        Route::get('/candidat/{id}', [EmployerController::class, 'showCandidate'])->name('employer.show');
        Route::post('/candidat/{id}/interview', [EmployerController::class, 'storeInterview'])->name('employer.store');
        Route::get('/statistik', [JobController::class, 'statistik'])->name('jobs.statistik');
        
    });

    // ROUTE KHUSUS SUPER ADMIN
    Route::middleware(['auth', 'verified', 'superadmin'])
        ->prefix('super-admin')
        ->name('superadmin.')
        ->group(function () {

            Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');
            Route::get('/users', [SuperAdminController::class, 'users'])->name('users');
            Route::get('/users/create', [SuperAdminController::class, 'createUser'])->name('users.create');
            Route::post('/users', [SuperAdminController::class, 'storeUser'])->name('users.store');
            Route::get('/users/{user}', [SuperAdminController::class, 'showUser'])->name('users.show');
            Route::get('/users/{user}/edit', [SuperAdminController::class, 'editUser'])->name('users.edit');
            Route::put('/users/{user}', [SuperAdminController::class, 'updateUser'])->name('users.update');
            Route::delete('/users/{id}', [SuperAdminController::class, 'destroyUser'])->name('users.destroy');
        });

    // ROUTE PROFIL USER (CANDIDATE)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ROUTE PROFIL CANDIDATE
    Route::get('/my-profile', [CandidateProfileController::class, 'edit'])->name('candidate.profile');
    Route::put('/my-profile', [CandidateProfileController::class, 'update'])->name('candidate.profile.update');
    Route::put('/my-profile/password', [CandidateProfileController::class, 'updatePassword'])->name('candidate.password.update');
});

require __DIR__ . '/auth.php';
