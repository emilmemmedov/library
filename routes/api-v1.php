<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'v1'], function ($app){

    $app->post('auth/register', [UserController::class, 'create']);

    $app->group(['prefix' => 'auth'], function ($app){
        $app->post('login', [AuthController::class, 'login']);
        $app->post('logout', [AuthController::class, 'logout' ]);
        $app->post('refresh', [AuthController::class, 'refresh' ]);
        $app->get('me', [AuthController::class, 'me' ]);
    });

    $app->group(['prefix' => 'admin', 'middleware' => 'auth'], function ($app){

        $app->group(['prefix' => 'reader'], function ($app){
            $app->get('/', [ReaderController::class, 'index']);
            $app->get('/{id}', [ReaderController::class, 'show']);

        });

        $app->group(['prefix' => 'order'], function ($app){
            $app->post('/', [OrderController::class, 'create']);
        });

        $app->group(['prefix' => 'book'], function ($app){
            $app->post('/', [BookController::class,'create']);
        });

        $app->group(['prefix' => 'librarian'], function ($app){
            $app->get('/statistic', [LibrarianController::class, 'statistic']); // statistic of librarian
        });

    });

    $app->group(['prefix' => 'client'], function ($app){
        $app->get('/book', [BookController::class,'index']);
        $app->get('/book/{id}', [BookController::class,'show']);
    });

});
