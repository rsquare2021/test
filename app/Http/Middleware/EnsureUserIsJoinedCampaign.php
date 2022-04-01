<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Redirect;

class EnsureUserIsJoinedCampaign
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
        $user = $request->user();
        if($user instanceof User) {
            $campaign_id = $request->route("campaign_id");
            if(!$user->isJoinedCampaign($campaign_id)) {
                return Redirect::route("campaign.entry", $campaign_id);
            }
        }

        return $next($request);
    }
}
