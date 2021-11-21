<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/o-mnie', [PublicController::class, 'about'])->name('about');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/photos', function () {
    return view('admin.photos');
})->name('photos');

Route::middleware(['auth:sanctum', 'verified'])->get('/albums', function () {
    return view('admin.albums');
})->name('albums');

Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('admin.home');
})->name('admin-home');

Route::middleware(['auth:sanctum', 'verified'])->get('/about', function () {
    return view('admin.about');
})->name('admin-about');

Route::middleware(['auth:sanctum', 'verified'])->get('/labels', function () {
    return view('admin.labels');
})->name('labels');

Route::get('/{page}', [PublicController::class, 'gallery'])->name('gallery');