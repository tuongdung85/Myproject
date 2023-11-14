<?php

use App\Http\Controllers\API\V1\OCR;
use App\Http\Controllers\API\V1\OCRController;
use App\Http\Controllers\API\V1\TaskController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use thiagoalessio\TesseractOCR\TesseractOCR;


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

// Route::middleware('auth:sanctum')->post('/login', function (Request $request) {
//     return $request->login();
// });

Route::middleware('auth:sanctum')->prefix("v1")->Group(function() {
    Route::apiResource("/task", TaskController::class);
    // Route::get('/task', 'TaskController@index');
} );

Route::get('/testOCR', [OCRController::class, 'index']);
Route::get('/testOCRWithPdf', [OCRController::class, 'getTextFromPdf']);
Route::get('/testOCRWithImage', [OCRController::class, 'getTextFromImage']);

// Route::get('/convertImageToPdf', [OCRController::class, 'convertImageToPdf']);


