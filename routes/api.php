<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController;

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

Route::apiResource('v1/brands', App\Http\Controllers\Api\V1\BrandController::class)->middleware('api');

Route::apiResource('v1/categories', App\Http\Controllers\Api\V1\CategoryController::class)->middleware('api');

Route::apiResource('v1/products', App\Http\Controllers\Api\V1\ProductController::class)->middleware('api');
Route::get('v1/products/search/{search?}',[ProductController::class, 'searchProducts'])->name('products.search')->middleware('api');