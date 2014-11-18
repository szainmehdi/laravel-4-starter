<?php namespace App\Routing;

use Illuminate\Routing\Router as IlluminateRouter;

class FrontendRouter extends Router {

    /**
     * Register routes.
     *
     * @return mixed
     */
    public function register()
    {

        // Homepage
        $this->router->get('/', named_route('home', 'Frontend::HomeController', 'index'));

        // Sessions Resource
        $this->registerResource('sessions', 'SessionsController');
    }

}