<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FolderController;



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

// Route::get('/', [FileController::class, 'index']);
// Route::resource('files', FileController::class)->only(['index', 'store']);
// Route::post('/folders', [FileController::class, 'createFolder'])->name('folders.create');

// Route::get('/files/{id}/download', [FileController::class, 'download'])->name('files.download');

// Rute untuk halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'login'])->name('login');


// Rute untuk halaman registrasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'register'])->name('register');


// Rute untuk halaman dashboard (setelah login)
Route::middleware(['auth'])->group(function () {
  // Tambahkan rute-rute dashboard lainnya jika diperlukan
  Route::get('/', [FileController::class, 'index']);
  Route::get('/listFolders', [FolderController::class, 'listFolders']);
  Route::get('/shared', [FileController::class, 'shared']);

  Route::resource('files', FileController::class)->only(['index', 'store']);
  Route::post('/folders', [FolderController::class, 'createFolder'])->name('folders.create');

  Route::get('/folders/{id}', [FolderController::class, 'detailFolder'])->name('folders.detailFolder');


  Route::get('/files/{id}/download', [FileController::class, 'download'])->name('files.download');
  Route::get('/files/{id}/deleteFile', [FileController::class, 'deleteFile'])->name('files.deleteFile');
  Route::get('/files/{id}/detailFile', [FileController::class, 'detailFile'])->name('files.detailFile');
  // web.php
  Route::put('/files/{id}/editFile', [FileController::class, 'editFile'])->name('files.editFile');
  Route::put('/folders/{id}/editFolder', [FolderController::class, 'editFolder'])->name('folders.editFolder');
});

// Rute logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
