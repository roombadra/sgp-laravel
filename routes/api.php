<?php

use App\Http\Controllers\Api\v1\Inventory\InventoryController;
use App\Http\Controllers\Api\v1\Organism\OrganismController;
use App\Http\Controllers\Api\v1\Projet\ProjetController;
use App\Http\Controllers\Api\v1\Scanner\ScannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\User\UserController;
use App\Http\Controllers\Api\v1\Auth\LoginController;
use App\Http\Controllers\Api\v1\Auth\LogoutController;

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

Route::post('login', [LoginController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::post('register', [AuthController::class, 'register']);

    Route::prefix('users')->group(function () {
        Route::middleware('admin')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('{user}', [UserController::class, 'show']);
            Route::post('/', [UserController::class, 'store']);
            Route::put('{user}', [UserController::class, 'update']);
            Route::delete('{user}', [UserController::class, 'destroy']);
        });
    });

    Route::prefix('organisms')->group(function () {
        Route::get('/', [OrganismController::class, 'index']);
        Route::get('{organism}', [OrganismController::class, 'show']);
        Route::post('/', [OrganismController::class, 'store']);
        Route::put('{organism}', [OrganismController::class, 'update']);
        Route::delete('{organism}', [OrganismController::class, 'destroy']);
    });

    Route::prefix('scanners')->group(function () {
        Route::get('/', [ScannerController::class, 'index']);
        Route::get('{scanner}', [ScannerController::class, 'show']);
        Route::post('/', [ScannerController::class, 'store']);
        Route::put('{scanner}', [ScannerController::class, 'update']);
        Route::delete('{scanner}', [ScannerController::class, 'destroy']);
    });

    Route::prefix('projets')->group(function () {
        Route::get('/', [ProjetController::class, 'index']);
        Route::get('{projet}', [ProjetController::class, 'show']);
        Route::post('/', [ProjetController::class, 'store']);
        Route::put('{projet}', [ProjetController::class, 'update']);
        Route::delete('{projet}', [ProjetController::class, 'destroy']);
    });

    Route::prefix('inventories')->group(function () {
        Route::get('/', [InventoryController::class, 'index']);
        Route::get('{inventory}', [InventoryController::class, 'show']);
        Route::post('/', [InventoryController::class, 'store']);
        Route::put('{inventory}', [InventoryController::class, 'update']);
        Route::delete('{inventory}', [InventoryController::class, 'destroy']);
    });

    Route::post('logout', [LogoutController::class, 'logout']);
});
