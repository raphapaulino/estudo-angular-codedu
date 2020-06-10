<?php

namespace App\Providers;

use App\Auth\AdminProvider;
use App\Auth\TenantProvider;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Auth::provider('admin_provider', function ($app, array $config) {
            return new AdminProvider($app['hash'], $config['model']); // 'model' é declarado em config/auth.php array providers=>users=>model
        });

        \Auth::provider('tenant_provider', function ($app, array $config) {
            return new TenantProvider($app['hash'], $config['model']); // 'model' é declarado em config/auth.php array providers=>users=>model
        });
    }
}
