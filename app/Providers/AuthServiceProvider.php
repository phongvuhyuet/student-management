<?php

namespace App\Providers;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-students', function (User $user, Classes $class) {
            return $user->role_id == 1 && $class->consultant->id == $user->id;
        });

        Gate::define('manage-tasks', function (User $user) {
            return $user->role_id == 1;
        });
        Gate::define('view-mark', function (User $user, $id) {
            return ($user->role_id == 1 || $user->id == $id);
        });
    }
}
