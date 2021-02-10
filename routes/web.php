<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestAPIController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
/*
Route::get('/{any}', function(){
    return view('welcome');
})->where('any', '^(?!api).*$');
*/
/*
Route::get('recipes', [TestAPIController::class, 'getAll']);
Route::get('recipes/{ID}',[TestAPIController::class, 'getID']);
Route::post('recipes', [TestAPIController::class, 'post']);
Route::patch('recipes/{ID}',[TestAPIController::class, 'patch']);
Route::delete('recipes/{ID}',[TestAPIController::class, 'delete']);
*/
