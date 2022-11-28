<?php

use Illuminate\Support\Facades\Route;
use Ogilo\Partners\Http\Controllers\Api\V1\PartnerController;

Route::name('api')
    ->prefix('api')
    ->group(function () {
        Route::name('-v1')
            ->prefix('v1')
            ->group(function () {
                Route::name('-partners')
                    ->prefix('partners')
                    ->group(function () {
                        Route::get('', [PartnerController::class, 'index']);
                        Route::post('', [PartnerController::class, 'store']);
                        Route::patch('', [PartnerController::class, 'update']);
                        Route::delete('', [PartnerController::class, 'delete']);
                    });
            });
    });
