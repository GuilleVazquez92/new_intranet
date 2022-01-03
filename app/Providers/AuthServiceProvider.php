<?php

namespace App\Providers;

use App\Models\Team;
use App\Policies\TeamPolicy;
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
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

    Gate::define('gerente-user', 'App\Http\Controllers\GateController@GGUser');

    Gate::define('logistica-user', 'App\Http\Controllers\GateController@LogisticaUser');
    
    Gate::define('logistica-admin', 'App\Http\Controllers\GateController@LogisticaAdmin');
    
    Gate::define('cobranza-user', 'App\Http\Controllers\GateController@CobranzaUser');

    Gate::define('jefes-canal', 'App\Http\Controllers\GateController@JefesCanal');
    }
}
