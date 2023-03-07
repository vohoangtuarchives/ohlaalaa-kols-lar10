<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $currentURL = $request->url();
        if (! $request->expectsJson()) {
            if(Str::contains(Route::currentRouteName(), 'dashboard')){
                return route('dashboard.login');
            }
            return route('login');
        }

        if(is_numeric(strpos($currentURL, 'dashboard')) && strpos($currentURL, 'dashboard') <=1){
            return $request->expectsJson() ? null : route(config("admin.admin_prefix").'.login');
        }
        return $request->expectsJson() ? null : route('login');
    }
}
