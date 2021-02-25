<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Qwshop\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Str;

class RouteServiceProvider extends ServiceProvider
{
    protected $path;

    protected $config;

    protected $prefix;

    protected $frontendNamespace;

    protected $backendNamespace;

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
        $this->path = goodcatch_vendor_path ('/laravel-modules-qwshop/src/routes');
        $this->prefix =$this->getModuleConfig ('route.prefix', 'm');
        $this->frontendNamespace = $this->getModuleConfig ('route.frontend.namespace', 'Http\\Controllers\\Front');
        $this->backendNamespace = $this->getModuleConfig ('route.backend.namespace', 'Http\\Controllers\\Admin');
        $this->apiNamespace = $this->getModuleConfig ('route.api.namespace', 'Http\\Controllers\\Api');
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


        $this->mapRoutes();

    }


    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapRoutes ()
    {
        if (app ()->has ('laravellocalization')) {


        }

    }

}
