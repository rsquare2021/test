<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified as MiddlewareEnsureEmailIsVerified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;

class EnsureEmailIsVerified extends MiddlewareEnsureEmailIsVerified
{
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (! $request->user() ||
            ($request->user() instanceof MustVerifyEmail &&
            ! $request->user()->hasVerifiedEmail())) {
            return $request->user()->hasSnsLogin() ?
                Redirect::route("campaign.email.edit", $request->route("campaign_id")) :
                Redirect::route("campaign.email.resend", $request->route("campaign_id"))
            ;
        }

        return $next($request);
    }
}
