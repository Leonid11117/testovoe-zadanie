<?php

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

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'tasks', 'name' => 'tasks'], static function (\Illuminate\Routing\Router $router) {
    $router->post('/batch', \App\Http\Controllers\Tasks\BatchCreateController::class);
    $router->post('/', \App\Http\Controllers\Tasks\CreateController::class);
    $router->get('/', \App\Http\Controllers\Tasks\IndexController::class);
    $router->get('/{id}', \App\Http\Controllers\Tasks\ViewController::class)->whereNumber('id');
    $router->post('/{id}', \App\Http\Controllers\Tasks\UpdateController::class)->whereNumber('id');
    $router->delete('/{id}', \App\Http\Controllers\Tasks\DeleteController::class)->whereNumber('id');
});

Route::post('/register', \App\Http\Controllers\Auth\RegisterController::class);
Route::post('/login', \App\Http\Controllers\Auth\LoginController::class);
