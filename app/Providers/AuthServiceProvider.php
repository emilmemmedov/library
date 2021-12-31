<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('get-reader', function (User $user) {
            return $user->type == User::READER_TYPE;
        });

        Gate::define('get-librarian', function (User $user){
            return $user->type == User::LIBRARIAN_TYPE;
        });

        Gate::define('get-author', function (User $user){
            return $user->type == User::LIBRARIAN_TYPE;
        });
    }
}
