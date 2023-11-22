<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\Gate; // 11.21 Gates are simply closures that determine if a user is authorized to perform a given action

use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Paginator::useBootstrap();  //paginatorが綺麗になる。　11.16

        // 11.21 Define 'admin' gate based on user's role
        Gate::define('admin', function($user) {
            return $user->role_id == User::ADMIN_ROLE_ID;
            // Sets up a 'admin' gate allowing access based on the users role
            // The closure checks if the user's role ID matches the admin role ID
        });
    }
}
