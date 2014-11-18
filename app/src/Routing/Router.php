<?php namespace App\Routing;

use Illuminate\Routing\Router as IlluminateRouter;
use Str;

abstract class Router
{

    /**
     * @var IlluminateRouter
     */
    protected $router;

    public function __construct(IlluminateRouter $router)
    {
        $this->router = $router;
    }

    /**
     * Register routes.
     *
     * @return mixed
     */
    public abstract function register();

    protected function registerResource($resource, $controller, $options = [])
    {
        $prefix = array_get($options, 'prefix', '');
        $actions = array_get($options, 'actions', ['index', 'store', 'create', 'show', 'edit', 'update', 'destroy']);

        if (!empty($prefix) && !Str::endsWith($prefix, '.')) {
            $prefix .= '.';
        }

        $placeholder = '{' . Str::singular($resource) . '}';

        foreach ($actions as $action) {
            $registerAction = 'registerResource' . \Str::title($action);
            if (method_exists($this, $registerAction)) {
                $this->$registerAction($resource, $placeholder, $controller, $prefix);
            }
        }
    }

    private final function registerResourceIndex($resource, $placeholder, $controller, $prefix = '')
    {
        $this->router->get("/{$resource}", named_route($prefix . $resource, $controller, "index"));
    }

    private final function registerResourceStore($resource, $placeholder, $controller, $prefix = '')
    {
        $this->router->post("/{$resource}", named_route($prefix . $resource . ".store", $controller, "store"));
    }

    private final function registerResourceCreate($resource, $placeholder, $controller, $prefix = '')
    {
        $this->router->get("/{$resource}/create", named_route($prefix . $resource . ".create", $controller, "create"));
    }

    private final function registerResourceShow($resource, $placeholder, $controller, $prefix = '')
    {
        $this->router->get("/{$resource}/{$placeholder}",
            named_route($prefix . $resource . ".show", $controller, "show"));
    }

    private final function registerResourceEdit($resource, $placeholder, $controller, $prefix = '')
    {
        $this->router->get("/{$resource}/{$placeholder}/edit",
            named_route($prefix . $resource . ".edit", $controller, "edit"));
    }

    private final function registerResourceUpdate($resource, $placeholder, $controller, $prefix = '')
    {
        $this->router->put("/{$resource}/{$placeholder}",
            named_route($prefix . $resource . ".update", $controller, "update"));

        $this->router->patch("/{$resource}/{$placeholder}", to_controller($controller, "update"));
    }

    private final function registerResourceDestroy($resource, $placeholder, $controller, $prefix = '')
    {
        $this->router->delete("/{$resource}/{$placeholder}",
            named_route($prefix . $resource . ".destroy", $controller, "destroy"));
    }

} 