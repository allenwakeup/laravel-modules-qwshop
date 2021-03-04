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
            $src = goodcatch_vendor_path ('/laravel-modules-qwshop');
            $this->publishes ([
                $src . '/resources' =>  resource_path(),
                $src . 'routes/web.php' => base_path('routes/web.php')
            ], 'goodcatch-modules-qwshop');
        }
    }

}
