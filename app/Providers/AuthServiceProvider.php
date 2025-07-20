<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Produit;
use App\Models\Stand;
use App\Models\Commande;
use App\Policies\ProduitPolicy;
use App\Policies\StandPolicy;
use App\Policies\CommandePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Produit::class => ProduitPolicy::class,
        Stand::class => StandPolicy::class,
        Commande::class => CommandePolicy::class,
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
