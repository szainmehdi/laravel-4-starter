<?php namespace App\Routing;

use Illuminate\Routing\Router as IlluminateRouter;
use Str;

abstract class Router {

    public function __construct() {

    }

    /**
     * Register routes.
     *
     * @param IlluminateRouter $router
     *
     * @return mixed
     */
    public abstract function register(IlluminateRouter $router);

    protected function registerResource(IlluminateRouter $router, $resource, $controller, $prefix = '') {
        if (!Str::endsWith($prefix, '.')) {
            $prefix .= '.';
        }
        $placeholder = '{' . Str::singular($resource) . '}';

        $router->get("/{$resource}", named_route($prefix . $resource, $controller, "index"));
        $router->post("/{$resource}", named_route($prefix . $resource . ".store", $controller, "store"));
        $router->get("/{$resource}/create", named_route($prefix . $resource . ".create", $controller, "create"));
        $router->get("/{$resource}/{$placeholder}", named_route($prefix . $resource . ".show", $controller, "show"));
        $router->get("/{$resource}/{$placeholder}/edit",
            named_route($prefix . $resource . ".edit", $controller, "edit"));
        $router->put("/{$resource}/{$placeholder}",
            named_route($prefix . $resource . ".update", $controller, "update"));
        $router->patch("/{$resource}/{$placeholder}", to_controller($controller, "update"));
        $router->delete("/{$resource}/{$placeholder}",
            named_route($prefix . $resource . ".destroy", $controller, "destroy"));
    }

} 