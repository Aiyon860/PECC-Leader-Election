<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/vote', function () {
    return view('user.vote');
})->middleware(['auth', 'verified'])->name('vote');

Route::post('/thank-you', function () {
    return view('user.thank-you');
})->middleware(['auth', 'verified'])->name('thank-you');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/result', function () {
    return view('admin.result');
})->middleware(['auth', 'verified'])->name('result');

Route::get('/candidates', function () {
    return view('admin.candidates.display-candidates');
})->middleware(['auth', 'verified'])->name('display-candidates');

Route::get('/candidate/add', function () {
    return view('admin.candidates.add-candidate-form');
})->middleware(['auth', 'verified'])->name('add-candidate-page');

Route::post('/candidate/add', function () {
    return redirect()->route("display-candidates")->with("success", "Candidate added succesfully!");
})->middleware(['auth', 'verified'])->name('add-candidate-post');

Route::get('/candidate/edit', function () {
    return view('admin.candidates.edit-candidate-form');
})->middleware(['auth', 'verified'])->name('edit-candidate-page');

Route::put('/candidate/edit', function () {
    return redirect()->route("display-candidates")->with("success", "Candidate updated succesfully!");
})->middleware(['auth', 'verified'])->name('edit-candidate-put');

Route::delete('/candidate/remove', function () {
    return redirect()->route("display-candidates")->with("success", "Candidate deleted succesfully!");
})->middleware(['auth', 'verified'])->name('remove-candidate-delete');

Route::get('/voters', function () {
    return view('admin.voters.display-voters');
})->middleware(['auth', 'verified'])->name('display-voters');

Route::get('/voter/add', function () {
    return view('admin.voters.add-voter-form');
})->middleware(['auth', 'verified'])->name('add-voter-page');

Route::post('/voter/add', function () {
    return redirect()->route("display-voters")->with("success", "Voter added succesfully!");
})->middleware(['auth', 'verified'])->name('add-voter-post');

Route::get('/voters/import', function () {
    return view('admin.voters.import-voters');
})->middleware(['auth', 'verified'])->name('import-voters-page');

Route::post('/voters/import', function () {
    return redirect()->route("display-voters")->with("success", "Voters list exported succesfully!");
})->middleware(['auth', 'verified'])->name('import-voters-post');

Route::delete('/voter/remove', function () {
    return redirect()->route("display-voters")->with("success", "Voter deleted succesfully!");
})->middleware(['auth', 'verified'])->name('remove-voter-delete');

Route::delete('/voters/remove', function () {
    return redirect()->route("display-voters")->with("success", "Voters deleted succesfully!");
})->middleware(['auth', 'verified'])->name('remove-voters-delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
