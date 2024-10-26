<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
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
Route::get('students/edit/{id}', [StudenController::class, 'edit'])->name('students.edit')->middleware('admin');
Route::put('students/edit/{id}', [StudenController::class, 'update'])->name('students.update')->middleware('admin');
Route::delete('students/delete/{id}', [StudenController::class, 'delete'])->name('students.delete')->middleware('admin');

Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('posts/create', [PostController::class, 'store'])->name('posts.store');
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
Route::put('posts/edit/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('posts/delete/{id}', [PostController::class, 'delete'])->name('posts.delete');

Route::get('images', [ImageController:: class, 'index']);
require __DIR__.'/auth.php';
