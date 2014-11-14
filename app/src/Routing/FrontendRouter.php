<?php namespace AutoAdsToday\Routing;

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
        $router->group(['domain' => subdomain('dashboard'), 'before' => 'auth|dashboard'], function () use ($router) {

            $router->get('/settings', named_route('dashboard.settings', 'Dashboard::DashboardController', 'settings'));
            $this->users($router);
            $router->get('/', named_route('dashboard.index', 'Dashboard::DashboardController', 'dashboard'));

        });
        $router->group(['domain' => subdomain('dashboard')], function () use ($router) {

            $router->get('login', named_route('dashboard.login', 'SessionsController', 'create'))
                ->before('guest');
            $router->get('logout', named_route('dashboard.logout', 'SessionsController', 'destroy'));
            $router->resource('sessions', controller('SessionsController'), ['only' => ['create', 'store', 'destroy']]);

        });
    }

    private function users(IlluminateRouter $router) {
        $router->group(['before' => 'role:manager'], function () use ($router) {
            $this->registerResource($router, 'users', 'Dashboard::UsersController', 'dashboard');
        });

        // User Dealer Association
        $router->group(['before' => 'role:admin'], function () use ($router) {
            $router->get('/users/{user}/dealers/create',
                named_route('dashboard.users.dealers.create', 'Dashboard::UserDealersController', 'create'));
            $router->post('/users/{user}/users',
                named_route('dashboard.users.dealers.store', 'Dashboard::UserDealersController', 'store'));
            $router->delete('/users/{user}/dealers/{dealer}/',
                named_route('dashboard.users.dealers.destroy', 'Dashboard::UserDealersController', 'destroy'));
        });
    }

}