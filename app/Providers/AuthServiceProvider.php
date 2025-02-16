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

//VA
        /* define a admin user role */
        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
         });
        
         /* define a manager user role */
         Gate::define('isManager', function($user) {
             return $user->role == 'manager' || $user->role == 'admin';
         });
       
         /* define a user role */
         Gate::define('isUser', function($user) {
             return $user->role == 'user';
         });



        /* define a user nipponia role */
        Gate::define('isWarehouseAdministrator', function($user) {
        return $user->role == 'warehouse_administrator';
        });

        /* define a user ECCITY role */
        Gate::define('isMarketingUser', function($user) {
        return $user->role == 'marketing_user';
        });



//VA












        //
    }
}
