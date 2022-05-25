<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        //
         Gate::before(function ($user, $ability) {
            if ($user->role=='admin') {
                return true;
            }
        });
        Gate::define('isDoctor', function($user) {
            return $user->role == 'doctor';
         });
         Gate::define('isPatient', function($user) {
            return $user->role == 'patient';
         });
         Gate::define('manageReport', function($user,$report)
         {
             return $user->id === $report->user_id;
         });
    }
}
