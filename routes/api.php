<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CollectController;
use Illuminate\Support\Facades\DB;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'getProducts']);
    Route::get('/{id}', [ProductController::class, 'getProductById']);
    Route::post('/', [ProductController::class, 'createProduct']);
    Route::post('/{id}/variants', [VariantController::class, 'createVariant']);
    Route::post('/{id}/images', [ProductImageController::class, 'createProductImage']);
});

Route::post('/collections', [CollectionController::class, 'createCollection']);
Route::post('/collects', [CollectController::class, 'addProductToCollection']);

// DB::listen(function ($query) {
//     var_dump($query->sql);
// });