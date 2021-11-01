<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books', BookController::class);
Route::get('/export-books', [BookController::class, 'export']);
Route::post('book-import', [BookController::class, 'fileImport']);
Route::get('/search/books', [BookController::class, 'searchDate']);
Route::get('/search.name/books', [BookController::class, 'searchName']);
Route::get('/search.detail/books', [BookController::class, 'searchDetail']);

Route::resource('products', ProductController::class);
