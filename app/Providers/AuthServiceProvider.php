<?php

namespace App\Providers;

use App\Models\Championship;
use App\Models\Season;
use App\Policies\ChampionshipPolicy;
use App\Policies\SeasonPolicy;
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
        Championship::class => ChampionshipPolicy::class,
        Season::class => SeasonPolicy::class,
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
    }
}
