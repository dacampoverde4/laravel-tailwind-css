<?php

namespace App\Http\Middleware;

use DB;
use App\User;
use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class OnlineUser
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
        $onlineusers = User::where('is_online', 1)->where('last_activity', '<', Carbon::now()->subMinutes(5)->toDateTimeString())->pluck('id')->toArray();
        if( count( $onlineusers ) ){
            DB::table('users')->whereIn('id', $onlineusers)->update(['is_online' => 0 ] );
        } 
        if( Auth::user() ){
            User::where('id', '=', Auth::user()->id)->update(['is_online' => 1, 'last_activity' => Carbon::now() ]);
        }
        return $next($request);
    }
}
