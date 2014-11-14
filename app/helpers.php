<?php

/**
 * Returns the FQN for a controller.
 *
 * @param $class string Class name, including namespace from \App\Controllers\{...}
 *
 * @return string FQN of the controller
 * ex. controller('DashboardController') => \App\Controllers\DashboardController
 * ex. controller('Dashboard\DashboardController') => \App\Controllers\Dashboard\DashboardController
 * ex. controller('Dashboard::DashboardController') => \App\Controllers\Dashboard\DashboardController
 * ex. controller('Dashboard.DashboardController') => \App\Controllers\Dashboard\DashboardController
 */
function controller($class) {

    $class = str_replace(['::', '.'], '\\', $class);

    return '\App\Controllers\\' . $class;

}

/**
 * Generates a controller action string.
 *
 * @param $controller
 * @param $action
 *
 * @return string
 */
function method($controller, $action) {

    if (!Str::startsWith('\\', $controller)) {
        $controller = controller($controller);
    }

    return $controller . '@' . $action;

}

/**
 * Returns an array containing a route specification for Laravel's router.
 *
 * @param $controller
 * @param $action
 * @param array $parameters
 *
 * @return array
 */
function to_controller($controller, $action, $parameters = []) {
    return array_merge(['uses' => method($controller, $action)], $parameters);
}

/**
 * Returns an array containing a named route specification for Laravel's router.
 *
 * @param $name
 * @param $controller
 * @param $action
 *
 * @return array
 */
function named_route($name, $controller, $action) {
    return to_controller($controller, $action, ['as' => $name]);
}

/**
 * Generates a view.
 *
 * @param $name
 *
 * @return \Illuminate\View\View
 */
function view($name) {
    return View::make($name);
}

/**
 * Returns a complete domain name with the passed in subdomain.
 * ex. subdomain('example') => 'example.domain.com'
 *
 * @param $str string
 *
 * @return string
 */
function subdomain($str) {
    return $str . '.' . Config::get('app.domain');
}


function redirect_back_or_to($default_route, $route_params = [], $code = 302, $headers = []) {
    try {
        return Redirect::back($code, $headers);
    } catch (InvalidArgumentException $e) {
        return Redirect::route($default_route, $route_params, $code, $headers);
    }
}
