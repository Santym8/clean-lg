<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('has-rol', function (User $user, $role_names) {

            foreach ($role_names as $rol_name) {
                if ($user->roles->where('status', 1)->contains('name', $rol_name)) {
                    return true;
                }
            }
            return false;
        });

        Gate::define('action-allowed-to-user', function (User $user, $action_name) {
            foreach ($user->roles as $role) {
                if (!$role->status) {
                    continue;
                }
                foreach ($role->moduleActions as $action) {
                    if (!$action->status || !$action->module->status) {
                        continue;
                    }

                    if ($action->name == $action_name) {
                        return true;
                    }
                }
            }
            return false;
        });

        Gate::define('has-access-to-at-least-one-action-module', function (User $user, $module_name) {
            foreach ($user->roles as $role) {
                if (!$role->status) {
                    continue;
                }
                foreach ($role->moduleActions as $action) {
                    if (!$action->status || !$action->module->status) {
                        continue;
                    }

                    if ($action->module->name == $module_name) {
                        return true;
                    }
                }
            }
            return false;
        });
    }
}
