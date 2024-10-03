<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudenController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
});

Route::get('students/create', [StudenController::class, 'create'])->name('students.create');
Route::post('students/create', [StudenController::class, 'store'])->name('students.store');
Route::get('students', [StudenController::class, 'index'])->name('students.index');
Route::get('students/edit/{id}', [StudenController::class, 'edit'])->name('students.edit');
Route::put('students/edit/{id}', [StudenController::class, 'update'])->name('students.update');
Route::delete('students/delete/{id}', [StudenController::class, 'delete'])->name('students.delete');
require __DIR__.'/auth.php';
