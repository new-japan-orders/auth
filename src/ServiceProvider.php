<?php
namespace NewJapanOrders\Auth;

use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider {
    /** 
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'auth');
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