<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('tutor-access', function ($user) {
            return $user->hasRole('tutor');
        });
        Gate::define('school-access', function ($user) {
            return $user->hasRole('school');
        });
        Gate::define('shuttle-access', function ($user) {
            return $user->hasRole('shuttle');
        });
        Gate::define('organiser-access', function ($user) {
            return $user->hasRole('organiser');
        });
        Gate::define('admin-access', function ($user) {
            return $user->hasRole('admin');
        });
        Gate::define('institution-access', function ($user) {
            return $user->hasRole('institution');
        });
        //
    }
}
