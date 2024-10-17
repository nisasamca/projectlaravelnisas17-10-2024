<?php
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/recipe', [RecipeController::class, 'index'])->name('recipe');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');


Route::prefix('recipe')->name('recipe.')->group(function () {
    Route::get('/data',[RecipeController::class, 'index'])->name('data');
    Route::get('/tambah',[RecipeController::class, 'create'])->name('tambah');
    Route::post('/tambah/proses', [RecipeController::class, 'store'])->name('tambah.proses');
    Route::get('/ubah/{id}',[RecipeController::class, 'edit'])->name('ubah');
    Route::patch('/ubah/{id}/proses', [RecipeController::class, 'update'])->name('ubah.proses');
    Route::delete('/hapus/{id}', [RecipeController::class, 'destroy'])->name('hapus');

});
Route::prefix('/wishlist')->name('wishlist.')->group(function(){
    Route::get('/data',[WishlistController::class, 'index'])->name('data');
    Route::get('/tambah',[WishlistController::class, 'create'])->name('tambah');
    Route::post('/tambah/proses', [WishlistController::class, 'store'])->name('tambah.proses');
    Route::get('/ubah/{id}',[WishlistController::class, 'edit'])->name('ubah');
    Route::patch('/ubah/{id}/proses', [WishlistController::class, 'update'])->name('ubah.proses');
    Route::delete('/hapus/{id}', [WishlistController::class, 'destroy'])->name('hapus');
});


Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');