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

Route::group(
    [
        'prefix' => 'blog',
        'middleware' => ['api', ...config('larabizcms.auth_middleware', [])],
    ],
    function () {
        Route::apiResource('posts', \LarabizCMS\Modules\Blog\Http\Controllers\PostController::class);
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
