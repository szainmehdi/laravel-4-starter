<?php namespace App\Composers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        /** @var \View $view */
        $view = $this->app->make('view');

        $view->composer('home.layout.navbar', NavbarViewComposer::class);
    }
}