<?php
namespace App\Core\Providers;

use App\Core\Core;
use App\Mixins\RouterMixin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class CoreServiceProvider extends ServiceProvider{
    public function register()
    {
        include dirname(__DIR__) . DIRECTORY_SEPARATOR . "functions.php";

        foreach ([
                     "Customer" , "City", "District", "Ward"
                 ] as $key){
            $this->app->singleton(
                "App\\Repository\\".Str::plural($key)."\\{$key}RepositoryContract",
                "App\\Repository\\".Str::plural($key)."\\{$key}RepositoryCache"
            );
        }

        $this->app->singleton("core", function (){
            return new Core();
        });
    }

    public function boot(){
        \Illuminate\Routing\Route::mixin(new RouterMixin());
    }
}