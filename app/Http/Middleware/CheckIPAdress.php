<?php

namespace App\Http\Middleware;

use Closure;

class CheckIPAdress
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
            ['id' => 3, 'ip' => '160.86.107.67', 'name' => '株式会社Next.Tube 本社'],
            ['id' => 4, 'ip' => '61.206.126.151', 'name' => '株式会社燧'],
            ['id' => 5, 'ip' => '202.216.152.96', 'name' => '中田自宅'],
            ['id' => 6, 'ip' => '119.238.113.162', 'name' => 'RスクエアIP'],
            ['id' => 7, 'ip' => '153.156.226.166', 'name' => '株式会社オフィスあしずみ'],
            ['id' => 8, 'ip' => '124.110.153.19', 'name' => '株式会社オフィスあしずみ'],
            ['id' => 9, 'ip' => '153.127.33.112', 'name' => 'アンドファン株式会社'],
            ['id' => 10, 'ip' => '153.136.161.174', 'name' => '株式会社ビジネス・ソリューション'],
            ['id' => 11, 'ip' => '39.110.198.3', 'name' => '株式会社ミンナのシゴト'],
        ];
        // check your ip
        $detect = collect($ip)->contains('ip', $request->ip());
        if (!$detect) {
            abort(403);
        }
        return $next($request);
    }
}