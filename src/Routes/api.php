<?php

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

use LarabizCMS\Modules\Blog\Http\Controllers\PostController;

Route::group(
    [
        'prefix' => 'blog',
        'middleware' => ['api'],
    ],
    function () {
        Route::get('{type}', [PostController::class, 'index']);

        Route::get('{type}/{id}', [PostController::class, 'show']);

        Route::group(['middleware' => [...config('larabizcms.auth_middleware', [])]], function () {
            Route::post('{type}', [PostController::class, 'store']);

            Route::put('{type}/{id}', [PostController::class, 'update']);

            Route::delete('{type}/{id}', [PostController::class, 'destroy']);
        });
    }
);
