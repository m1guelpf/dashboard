<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        Gate::define('viewWebSocketsDashboard', function ($user = null) {
            if (app()->environment('local')) {
                return true;
            }

            if (request()->input('access-token') === config('app.access_token')) {
                return true;
            }
        });

        // in order to user private channels a user needs to be logged in
        if (Schema::hasTable(with(new User)->getTable())) {
            if ($user = User::first()) {
                auth()->login($user);
            }
        }

        $this->registerPolicies();
    }
}
