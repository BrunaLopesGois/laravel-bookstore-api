<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CheckoutController;
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

// Rotas de visuação de produto, sem necessidade de autenticação
Route::prefix('/books')->group(function () {
    Route::get('/', [BookController::class, 'index']);
    Route::get('/{id}', [BookController::class, 'show']);
});

// Rotas autenticadas
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::prefix('/books')->group(function () {
        Route::post('/', [BookController::class, 'store']);
        Route::delete('/{id}', [BookController::class, 'destroy']);
        Route::put('/{id}', [BookController::class, 'update']);
    });
    Route::post('/checkout/books/{id}', [CheckoutController::class, 'checkout']);
});

// Rotas de autenticação
Route::post('/login', [AuthController::class, 'signOn']);
