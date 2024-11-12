<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage_roles', function ($user) {
            return $user->is_admin;
        });

        Gate::define('view_materials', function ($user) {
            return $user->is_worker || $user->is_admin;
        });

        Gate::define('edit_products', function ($user) {
            return $user->is_admin;
        });

        Gate::define('manage_units', function ($user) {
            return $user->is_admin;
        });
    }
}
