<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected $user_route = "campaign.login";
    protected $admin_route = "admin.login";

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // if (! $request->expectsJson()) {
        //     return route('login');
        // }

        if(!$request->expectsJson()) {
            if(Route::is('campaign.*')) {
                return route($this->user_route, $request->route("campaign_id"));
            }
            elseif (Route::is('admin.*') or $request->is("/")) {
                return route($this->admin_route);
            }
        }
    }
}
