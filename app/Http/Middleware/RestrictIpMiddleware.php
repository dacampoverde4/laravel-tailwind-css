<?php

namespace App\Http\Middleware;

use Closure;
use App\Bannedips;

class RestrictIpMiddleware
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
        $bannedips = Bannedips::select('ip_address')->get()->toArray();
        //dd(array_values($bannedips));
        //$restricted_ip = $bannedips; 
        //$ipsDeny = explode(',',preg_replace('/\s+/', '', $restricted_ip));
        if(count($bannedips) > 0 )
        {
            if(array_search('117.247.90.154',array_column($bannedips, 'ip_address'))!== FALSE)
            {
                \Log::warning("Unauthorized access, IP address was => ".request()->ip);
               abort(404);
            }
        }
        return $next($request);
    }
}
