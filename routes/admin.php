<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')
    ->name('admin')
    ->prefix('admin')
    ->group(function () {

        Route::middleware('auth:admin')
            ->name('-partners')
            ->prefix('partners')
            ->group(function () {
                Route::get('', function () {
                    return view('partners::admin.index');
                });
            });
    });
