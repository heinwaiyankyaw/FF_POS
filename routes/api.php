<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\routeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products/list',[routeController::class,'products']);
Route::get('categories/list',[routeController::class,'categories']);
Route::get('users/list',[routeController::class,'users']);
Route::get('ordersList',[routeController::class,'ordersList']);

Route::post('create/category',[routeController::class,'createCategory']);
Route::post('create/contact',[routeController::class,'createContact']);
Route::post('delete/category',[routeController::class,'deleteCategory']);
