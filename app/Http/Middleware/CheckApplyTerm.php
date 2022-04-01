<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CheckApplyTerm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user_id = $request->user()->id;
        if($user_id == 4 || $user_id == 5 || $user_id == 179) {
            return $next($request);
        } else {
            $carbon = new Carbon();
            $carbon = Carbon::now();
            $carbon2 = new Carbon('2022-04-01');
            if($carbon->gte($carbon2)) {
                return $next($request);
            } else {
                return redirect()->route("campaign.dashboard", $request->route("campaign_id"));
            }
        }
    }
}
