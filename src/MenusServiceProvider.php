<?php

namespace Hechoenlaravel\JarvisMenus;

use Illuminate\Support\ServiceProvider;

class MenusServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->registerNamespaces();
        $this->registerMenusFile();
    }

    /**
     * Require the menus file if that file is exists.
     */
    public function registerMenusFile()
    {
        if (file_exists($file = app_path('Support/menus.php'))) {
            require $file;
        }
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('menu', function ($app) {
            return new Menu(app('view'), app('config'));
        });
    }

    /**
     * Register package's namespaces.
     */
    protected function registerNamespaces()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'menus');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'menus');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('menus.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/jplatformui/menus'),
        ], 'views');
    }
}
