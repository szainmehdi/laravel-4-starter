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
        $this->registerResource('sessions', 'SessionsController', ['actions' => ['create', 'store', 'destroy']]);
        $this->router->get('login', named_route('login', 'SessionsController', 'create'));
        $this->router->get('logout', named_route('logout', 'SessionsController', 'destroy'));
        $this->router->get('signup', named_route('signup', 'Frontend::UsersController', 'create'));

    }

}