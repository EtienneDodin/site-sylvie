<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('index');
Route::get('/contact', [HomeController::class,'contact'])->name('contact');
Route::get('/mon-travail', [HomeController::class,'myWork'])->name('work');
Route::get('/mentions-legales', [HomeController::class,'legalNotice'])->name('legalnotice');
Route::get('/politique-de-confidentialite', [HomeController::class,'privacyPolicy'])->name('privacypolicy');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/creations', [AdminController::class,'index'])->name('creations.index');
Route::get('/creations/create', [AdminController::class,'create'])->name('creations.create');
Route::post('/creations/store', [AdminController::class,'store'])->name('creations.store');
Route::post('/images/store/{creation}', [AdminController::class,'storeImage'])->name('images.store');
Route::get('/creations/edit/{creation}', [AdminController::class,'edit'])->name('creations.edit');
Route::get('/creations/show/{creation}', [AdminController::class,'show'])->name('creations.show');
Route::put('/creations/update/{creation}', [AdminController::class,'update'])->name('creations.update');
Route::delete('/creations/destroy/{creation}', [AdminController::class,'destroyCreation'])->name('creations.destroy');
});
