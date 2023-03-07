<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

class DashboardAuthorization
{

    public function handle($request, \Closure $next)
    {
        if(Auth::check() && !Auth::user()->can(Route::currentRouteName())){
            return abort(403);
        }
        return $next($request);
    }
}
