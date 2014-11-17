<?php namespace App\Routing;

use Illuminate\Routing\Router as IlluminateRouter;

class FrontendRouter extends Router {

    /**
     * Register routes.
     *
     * @param IlluminateRouter $router
     *
     * @return mixed
     */
    public function register(IlluminateRouter $router) {

        $router->get('/', function () {
            return view('hello');
        });

    }

}