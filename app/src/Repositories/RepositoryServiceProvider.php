<?php namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(User\UserRepository::class, User\EloquentUserRepository::class);
        $this->app->bind(Role\RoleRepository::class, Role\EloquentRoleRepository::class);
        $this->app->bind(Permission\PermissionRepository::class, Permission\EloquentPermissionRepository::class);
    }
}