<?php

namespace App\Providers;

use App\EnumsScope;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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
    public function boot(): void
    {
        Gate::before(function (User $user) {
            if ($user->scope == EnumsScope::ROOT) {
                return true;
            }
        });
        
        Gate::define('access-login', function (User $user) {
            return ($user ? true : false);
        });

        Gate::define('access-admin', function (User $user) {
            if (in_array($user->scope, [EnumsScope::ADMIN, EnumsScope::ROOT])) {
                return true;
            } else {
                Log::warning('Someone tried to access admin page', [
                    'user_id' => $user->id,
                    'user_ip' => request()->ip(),
                ]);
            };
        });

        Gate::define('no-access', function (User $user) {
            return $user->scope === "root";
        });
    }
}
