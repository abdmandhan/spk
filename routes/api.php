<?php

use App\Http\Controllers\Api\AppController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\SpkController;
use App\Http\Controllers\UserController;
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

Route::get('app', [AppController::class, 'app']);
Route::resource('user', UserController::class);


Route::post('login', [AuthController::class, 'login']);

Route::group([
    'middleware'    => ['auth:sanctum']
], function () {
    Route::get('verify', [AppController::class, 'verify']);
    Route::get('options', [AppController::class, 'options']);

    //page
    Route::get('dashboard', [PageController::class, 'dashboard']);
    Route::get('spk', [SpkController::class, 'index']);
    Route::post('spk', [SpkController::class, 'store']);
    Route::get('spk/{id}', [SpkController::class, 'show']);
});
