<?php

namespace Goodcatch\Modules\Qwshop\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $integration = Str::lower (trim($this->app ['config']->get('modules.integration', '')));
        if (strcmp ($integration, 'qwshop'))
        {
            $this->app->register(RouteServiceProvider::class);
            $this->app->register(ResourcesServiceProvider::class);
        }
    }


}
