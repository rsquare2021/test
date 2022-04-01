<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class VerifiedEmailUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(
            ! $request->user()->hasSnsLogin() &&
            (
                $request->user() instanceof MustVerifyEmail &&
                ! $request->user()->hasVerifiedEmail()
            )
        ) {
            return redirect()->route("campaign.email.resend", $request->route("campaign_id"));
        }

        return $next($request);
    }
}
