<?php
/**
 * Created by PhpStorm.
 * User: Pavilion 21
 * Date: 16-09-2019
 * Time: 06:41 PM
 */

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;


class CheckUserData
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
        $user=$request->user();
        $current = Carbon::now();
        $exp_time = $user->suspend_exp_time;
        
          if ($current < $user->suspend_exp_time) {
              $date1 = new \DateTime(date('Y-m-d H:i:s', strtotime($current)));
              $date2 = new \DateTime(date('Y-m-d H:i:s', strtotime($exp_time)));

              // The diff-methods returns a new DateInterval-object...
              $diff = $date2->diff($date1);
              
              $blocked_days = $diff->format('%a Day');

              if($blocked_days == 0)
              {
                $blocked_days = $diff->format('%h hours');
              }

              $message ='Hello <strong>'.$user->name.'</strong> , your account is suspended for <strong>'.$blocked_days.'. Reason: </strong>'.$user->reason; 
              auth()->logout();
              return redirect()->route('welcome')->with(['warning' => $message]);
          }

          if (!$user->verified) {
              return redirect('account-setup');
          }
          return $next($request);
    }
}