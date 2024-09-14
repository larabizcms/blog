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
        Route::get('posts', [PostController::class, 'index']);

        Route::get('posts/{id}', [PostController::class, 'show']);

        Route::group(['middleware' => [...config('larabizcms.auth_middleware', [])]], function () {
            Route::post('posts', [PostController::class, 'store']);

            Route::put('posts/{id}', [PostController::class, 'update']);
        });
    }
);

// Route::group(
//     [
//         'prefix' => 'blog',
//         'middleware' => ['api'],
//     ],
//     function () {
//         Route::apiResource('posts', \LarabizCMS\Modules\Blog\Http\Controllers\PostController::class);
//     }
// );
