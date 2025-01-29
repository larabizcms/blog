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

use LarabizCMS\Modules\Blog\Http\Controllers\APIs\PostController;

Route::group(
    [
        'prefix' => 'blog',
        'middleware' => ['api'],
    ],
    function () {
        Route::group(
            [
                'prefix' => 'internal',
                'middleware' => [
                    ...config('larabizcms.auth_middleware', []),
                ]
            ],
            function () {
                require __DIR__ . '/apis/internal.php';
            }
        );

        Route::get('{type}', [PostController::class, 'index']);
        Route::get('{type}/related/{slug}', [PostController::class, 'related']);
        Route::get('{type}/{id}', [PostController::class, 'show']);
    }
);
