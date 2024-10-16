<?php

namespace App\Providers;


use App\Models\Inventory;
use App\Models\Organism;
use App\Models\Projet;
use App\Models\Scanner;
use App\Models\User;
use App\Policies\InventoryPolicy;
use App\Policies\OrganismPolicy;
use App\Policies\ProjetPolicy;
use App\Policies\ScannerPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Organism::class => OrganismPolicy::class,
        Scanner::class => ScannerPolicy::class,
        Projet::class => ProjetPolicy::class,
        Inventory::class => InventoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Passport::ignoreRoutes();
    }
}