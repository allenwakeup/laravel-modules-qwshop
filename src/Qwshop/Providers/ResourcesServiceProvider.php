<?php

namespace Goodcatch\Modules\Qwshop\Providers;

use Illuminate\Support\ServiceProvider;

class ResourcesServiceProvider extends ServiceProvider
{

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot ()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register ()
    {

        $this->registerViews ();
    }

    public function registerViews ()
    {
        if ($this->app->runningInConsole ()) {
            // $src = goodcatch_vendor_path ('/laravel-modules-qwshop/src');
            $this->publishes ([


            ], 'goodcatch-modules');
        }
    }

}
