<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicProductController;
use App\Http\Controllers\PrivateProductController;
use Symfony\Component\HttpFoundation\Response;

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

/*
 * These are Public API Routes.
 *
 */

Route::group(['prefix' => 'public'], function() {
  Route::get('/get-products-by-page', [PublicProductController::class, 'paginate']);
  Route::get('/get-products', [PublicProductController::class, 'index']);
  Route::get('/get-product/{product}', [PublicProductController::class, 'show']);
  Route::get('/get-products-sort-by-order', [PublicProductController::class, 'productsSortByOrder']);
  Route::get('/get-products-by-category', [PublicProductController::class, 'productsByCategory']);
});




/*
 * These are Private API Routes.
 *
 */

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/get-products-by-page', [PrivateProductController::class, 'paginate']);
  Route::get('/get-products', [PrivateProductController::class, 'index']);
  Route::get('/get-product/{product}', [PrivateProductController::class, 'show']);
  Route::get('/get-products-sort-by-order', [PrivateProductController::class, 'productsSortByOrder']);
  Route::get('/get-products-by-category', [PrivateProductController::class, 'productsByCategory']);
});



/**
 * These are Authorization Routes;
 *
 */
Route::middleware('auth:sanctum')->group(function () {
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('/user', function(){
    return Auth::user();
  });
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
