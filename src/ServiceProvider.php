<?php
namespace NewJapanOrders\Auth;

use Illuminate\Support\ServiceProvider as Provider;
use Illuminate\Console\DetectsApplicationNamespace;

class ServiceProvider extends Provider {
    
    use DetectsApplicationNamespace;

    /** 
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $packagePath = __DIR__.'/../';

        $this->app->router->group([
            'middleware' => 'web',
            'namespace' => $this->getAppNamespace() . 'Http\Controllers'
        ], function() use($packagePath) {
            require $packagePath . 'routes/web.php';
        });

        $this->app->singleton('command.nwo.auth.migration', function ($app) {
            return $app['NewJapanOrders\Auth\Commands\PublishMigrations'];
        }); 
        $this->commands('command.nwo.auth.migration');



        $this->loadViewsFrom($packagePath . 'resources/views', 'auth');
    }
    /** 
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {   
        
    }   
}