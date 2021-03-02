<?php

namespace Goodcatch\Modules\Qwshop\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class LightcmsServiceProvider
 *
 * the main service provider that configured, so that laravel-modules requires.
 *
 * @package Goodcatch\Modules\Providers
 */
class QwshopServiceProvider extends ServiceProvider
{

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ResourcesServiceProvider::class);
    }



    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $this->loadTranslationsFrom(
            goodcatch_vendor_path('/laravel-modules-qwshop/resources/lang'),
            'laravel-modules'
        );
    }


}
