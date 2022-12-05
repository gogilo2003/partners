<?php

namespace Ogilo\Partners;

use Illuminate\Support\ServiceProvider as BaseProvider;


class ServiceProvider extends BaseProvider
{
    function register()
    {
        $file = __DIR__ . '/Support/helpers.php';
        if (file_exists($file)) {
            require_once($file);
        }
    }

    public function boot()
    {
        config(['admin.menu.admin-partners' => 'Partners']);

        $this->loadRoutesFrom(__DIR__ . '/../routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api-v1.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'partners');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes(
            [
                __DIR__ . '/../config/partners.php' => config_path('partners.php'),
            ],
            'partners-config'
        );

        $this->publishes([
            __DIR__ . '/../public/css' => public_path('vendor/partners/css'),
            __DIR__ . '/../public/images' => public_path('vendor/partners/images'),
            __DIR__ . '/../public/js' => public_path('vendor/partners/js'),
        ], 'partners-assets');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/partners'),
        ], 'partners-views');
    }
}
