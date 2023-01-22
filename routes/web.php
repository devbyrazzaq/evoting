<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('splade')->group(function () {
    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/voter', [VoterController::class, 'index'])->name('voter.index');
        Route::post('/voter', [VoterController::class, 'store'])->name('voter.store');
        Route::get('/voter/{voter:username}/edit', [VoterController::class, 'edit'])->name('voter.edit');
        Route::put('/voter/{voter}', [VoterController::class, 'update'])->name('voter.update');
        Route::get('/voter/create', [VoterController::class, 'create'])->name('voter.create');
        Route::delete('/voter/{voter}', [VoterController::class, 'destroy'])->name('voter.destroy');
        Route::get('/voter/import', [VoterController::class, 'import'])->name('voter.import');
        Route::post('/voter/import', [VoterController::class, 'import'])->name('voter.import');

        Route::get('/candidate', [CandidateController::class, 'index'])->name('candidate.index');
    });

    require __DIR__.'/auth.php';
});
