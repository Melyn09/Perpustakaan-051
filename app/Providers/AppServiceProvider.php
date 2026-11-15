<?php

namespace App\Providers;

use App\Models\Peminjaman;
use App\Policies\PeminjamanPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        if (app()->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        Gate::define('kelola-buku', function ($user) {
            return $user->hasAnyRole(['Admin', 'Petugas']);
        });

        Gate::policy(Peminjaman::class, PeminjamanPolicy::class);
    }
}