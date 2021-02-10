<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestAPIController;

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


//Route::get('test', 'TestAPIController@index');

Route::get('recipes', [TestAPIController::class, 'getAll']);
Route::get('recipes/{ID}',[TestAPIController::class, 'getID']);
Route::post('recipes', [TestAPIController::class, 'post']);
Route::patch('recipes/{ID}',[TestAPIController::class, 'patch']);
Route::delete('recipes/{ID}',[TestAPIController::class, 'delete']);
