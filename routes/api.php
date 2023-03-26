<?php

use App\Http\Controllers\ZohoContactController;
use App\Http\Controllers\ZohoDealController;
use App\Http\Controllers\ZohoOAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/generate-token', [ZohoOAuthController::class, 'generateToken']);
Route::get('/refresh-token', [ZohoOAuthController::class, 'refreshToken']);
Route::post('/add-contact', [ZohoContactController::class, 'addContact']);
Route::post('/add-deal', [ZohoDealController::class, 'addDeal']);
