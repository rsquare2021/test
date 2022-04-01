<?php

namespace App\Http\Middleware;

use Closure;

class DebugIp
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
        $ip = [
            ['id' => 1, 'ip' => '172.18.0.1', 'name' => 'ローカル'],
            ['id' => 2, 'ip' => '172.21.0.1', 'name' => 'ローカル'],
            ['id' => 3, 'ip' => '61.206.126.151', 'name' => 'FLINT'],
            ['id' => 4, 'ip' => '202.216.152.96', 'name' => '中田自宅'],
        ];
        // check your ip
        $detect = collect($ip)->contains('ip', $request->ip());
        if (!$detect) {
            return redirect()->route("campaign.dashboard", $request->route("campaign_id"));
        }
        return $next($request);
    }
}
