<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CollectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginGoogleController;
use App\Http\Controllers\UserController;
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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'loginByEmailPassword']);
    Route::post('login/email-otp', [AuthController::class, 'loginWithEmail']);
    Route::get('/login/email-otp/verify', [AuthController::class, 'verifyEmailOtp'])->name('email_otp_verify');
    Route::post('register', [AuthController::class, 'register']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::middleware('auth:api')->group(function () {
        Route::get('user', [UserController::class, 'index']);
        Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::get('google', [LoginGoogleController::class, 'redirectToGoogle']);
    Route::get('google/callback', [LoginGoogleController::class, 'handleGoogleCallback']);
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'getProducts']);
    Route::get('/{id}', [ProductController::class, 'getProductById']);
    Route::post('/', [ProductController::class, 'createProduct']);
    Route::put('/{id}', [ProductController::class, 'updateProduct']);

    Route::get('/{id}/variants', [VariantController::class, 'getProductVariants']);
    Route::post('/{id}/variants', [VariantController::class, 'createVariant']);

    Route::get('/{id}/images', [ProductImageController::class, 'getProductImages']);
    Route::post('/{id}/images', [ProductImageController::class, 'createProductImage']);
});

Route::put('/variants/{id}', [VariantController::class, 'updateVariant']);
Route::put('/images/{id}', [ProductImageController::class, 'updateProductImage']);

Route::group(['prefix' => 'collections'], function () {
    Route::get('/', [CollectionController::class, 'getCollections']);
    Route::get('/{id}', [CollectionController::class, 'getCollectionById']);
    Route::get('/{id}/products', [CollectionController::class, 'getProductsInCollection']);
    Route::post('/', [CollectionController::class, 'createCollection']);
});

Route::post('/collects', [CollectController::class, 'addProductToCollection']);
