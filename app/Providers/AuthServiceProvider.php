<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Produit;
use App\Policies\ProduitPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Produit::class => ProduitPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any authentication/authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Optionnel : permettre à un admin de tout faire
        Gate::before(function ($user, $ability) {
            return $user->role === 'admin' ? true : null;
        });
    }
}
