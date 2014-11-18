<?php namespace App\Routing;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        /** @var \Illuminate\Routing\Router $router */
        $router = $this->app['router'];

        (new FrontendRouter($router))->register();
    }
}