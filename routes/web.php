<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CandidateController;

Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'create'])->name('login.create');
});

Route::middleware(['auth', 'role:voter|candidate', 'check.vote'])->group(function() {
    Route::get('/thank-you', [VoteController::class, 'thankYou'])->name('vote.thank-you');
    Route::get('/vote', [CandidateController::class, 'index'])->name('vote.index');
});

Route::middleware(['auth', 'check.vote'])->group(function () {
    Route::post('/vote/store', [VoteController::class, 'store'])->name('vote.store');
});

Route::middleware(['auth', 'role:admin', 'permission:manage dashboard'])
    ->get('/dashboard', [DashboardController::class, 'create'])
    ->name('dashboard.create');

Route::middleware(['auth', 'role:admin', 'permission:manage result'])
    ->get('/result', [CandidateController::class, 'index'])
    ->name('candidate.result');

Route::middleware(['auth', 'role:admin', 'permission:manage candidates'])->group(function() {
    Route::get('/candidates', [CandidateController::class, 'index'])->name('candidate.index');
    Route::get('/candidates/votes', [CandidateController::class, 'getVotes'])->name('candidate.get-votes');
    
    Route::get('/candidate/add', [CandidateController::class, 'create'])->name('candidate.create');
    Route::post('/candidate', [CandidateController::class, 'store'])->name('candidate.store');
    
    Route::get('/candidate/{candidate}/edit', [CandidateController::class, 'edit'])->name('candidate.edit');
    Route::patch('/candidate/{candidate}', [CandidateController::class, 'update'])->name('candidate.update');
    
    Route::delete('/candidate/{candidate}', [CandidateController::class, 'destroy'])->name('candidate.destroy');
});

Route::middleware(['auth', 'role:admin', 'permission:manage voters'])->group(function() {
    Route::get('/voters', [UserController::class, 'create'])->name('voters.index');
    
    Route::get('/voter/add', [UserController::class, 'viewAddForm'])->name('voters.create');
    Route::post('/voter', [UserController::class, 'store'])->name('voters.store');
    
    Route::get('/voters/import', [UserController::class, 'viewImportForm'])->name('voters.import');
    Route::post('/voters/import', [UserController::class, 'importVoters'])->name('voters.import-store');
});

Route::middleware('auth')->group(function () {    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

