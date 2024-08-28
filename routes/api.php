<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendapatanTenantController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TenantController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\AuthToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function(){
    Route::group(['prefix' => 'auth'], function(){
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/logout', [AuthController::class, 'logout'])->middleware(AuthToken::class);
    });
});

Route::middleware(AuthToken::class)->prefix('v1')->group(function(){
    Route::group(['prefix' => 'kantin'], function(){
        // Stok
        Route::get('/stok', [StokController::class, 'index']);
        Route::get('/stok/{id}', [StokController::class, 'show']);
        Route::post('/stok', [StokController::class, 'store']);

        // Penjualan
        Route::get('/penjualan', [PenjualanController::class, 'index']);
        Route::get('/penjualan/{id}', [PenjualanController::class, 'show']);
        Route::post('/penjualan', [PenjualanController::class, 'store']);

        // Tenant
        Route::get('/tenant', [TenantController::class, 'index']);
        Route::get('/tenant/{id}', [TenantController::class, 'show']);

        // Pendapatan Tenant
        Route::get('/pendapatan-tenant', [PendapatanTenantController::class, 'index']);
        Route::get('/pendapatan-tenant/{id}', [PendapatanTenantController::class, 'show']);
        Route::post('/pendapatan-tenant', [PendapatanTenantController::class, 'store']);

        Route::middleware(Admin::class)->group(function(){
            // Stok
            Route::post('/stok/{id}', [StokController::class, 'update']);
            Route::delete('/stok/{id}', [StokController::class, 'destroy']);

            // Penjualan
            Route::post('/penjualan/{id}', [PenjualanController::class, 'update']);
            Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy']);

            // Tenant
            Route::post('/tenant', [TenantController::class, 'store']);
            Route::post('/tenant/{id}', [TenantController::class, 'update']);
            Route::delete('/tenant/{id}', [TenantController::class, 'destroy']);

            // Pendapatan Tenant
            Route::post('/pendapatan-tenant/{id}', [PendapatanTenantController::class, 'update']);
            Route::delete('/pendapatan-tenant/{id}', [PendapatanTenantController::class, 'destroy']);
        });
    });
});
