<?php

use Illuminate\Support\Facades\Route;
use Ogilo\Partners\Http\Controllers\Api\V1\PartnerController;

Route::name('admin-api')
    ->prefix('admin/api')
    ->group(function () {
        Route::name('-v1')
            ->prefix('v1')
            ->group(function () {
                Route::name('-partners')
                    ->prefix('partners')
                    ->group(function () {
                        Route::get('', [PartnerController::class, 'index']);
                        Route::post('', [PartnerController::class, 'store']);
                        Route::put('logo', [PartnerController::class, 'logo']);
                        Route::patch('', [PartnerController::class, 'update']);
                        Route::patch('publish', [PartnerController::class, 'publish']);
                        Route::delete('', [PartnerController::class, 'delete']);
                    });
            });
    });
