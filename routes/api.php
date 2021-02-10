<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenresController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('books')->group(function () {
    Route::get('/', [BooksController::class, 'index']);   
    Route::delete('/{book_id}', [BooksController::class, 'deleteOne']); 
    Route::post('/', [BooksController::class, 'create']);
    Route::put('/', [BooksController::class, 'updateOrder']);
});

Route::prefix('genres')->group(function () {
    Route::get('/', [GenresController::class, 'index']);
    Route::get('/{genre_id}/books', [GenresController::class, 'getBooks']);
});