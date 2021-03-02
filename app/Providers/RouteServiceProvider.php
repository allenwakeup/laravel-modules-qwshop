<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Qwshop\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'Goodcatch\\Modules\\Qwshop\\Http\\Controllers\\';

    protected $path;

    protected $config;

    protected $prefix;

    protected $apiNamespace;

    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct ($app)
    {
        parent::__construct ($app);

        $this->config = $this->app ['config']->get ('modules', []);

        $this->initRoute ();

    }

    protected function initRoute ()
    {
        $this->path = goodcatch_vendor_path ('/laravel-modules-qwshop/routes');
    }

    protected function getModuleConfig ($key, $default)
    {
        return Arr::get ($this->config, $key, $default);
    }

    protected function getPath ($name = null)
    {
        return $this->path . '/' . (isset ($name) ? $name : 'web') . '.php';
    }



    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map ()
    {


        $this->mapApiRoutes();
        // $this->mapWebRoutes();

    }


    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes ()
    {
        Route::prefix ('goodcatch')
            ->middleware ('web')
            ->namespace ($this->namespace)
            ->group ($this->getPath ('web'));

    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes ()
    {
        Route::prefix ('api')
            ->middleware ('api')
            ->namespace ($this->namespace . $this->apiNamespace)
            ->group ($this->getPath ('api'));
    }

}
