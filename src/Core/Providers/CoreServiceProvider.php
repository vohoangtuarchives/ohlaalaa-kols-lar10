<?php
namespace App\Core\Providers;


use App\Core\Commands\KodingRepository;
use App\Core\Core;
use App\Core\Mixins\RouterMixin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class CoreServiceProvider extends ServiceProvider{
    public function register()
    {
        include dirname(__DIR__) . DIRECTORY_SEPARATOR . "functions.php";



        $this->app->singleton("core", function (){
            return new Core();
        });

        $this->commands([
            KodingRepository::class
        ]);
    }

    public function boot(){
        \Illuminate\Routing\Route::mixin(new RouterMixin());
    }
}