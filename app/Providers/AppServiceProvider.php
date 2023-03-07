<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ([
                     "Customer" , "City", "District", "Ward", 'Campaign', 'CampaignRebate', 'CampaignHistory', 'Setting',
                    'Role', 'Permission', 'RolePermissions', 'UserPermissions', 'UserRoles', 'User', 'CustomerCampaign'
                 ] as $key){
            $this->app->singleton(
                "App\\Repository\\".Str::plural($key)."\\{$key}RepositoryContract",
                "App\\Repository\\".Str::plural($key)."\\{$key}RepositoryCache"
            );
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
