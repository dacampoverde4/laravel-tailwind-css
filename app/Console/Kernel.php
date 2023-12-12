<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        '\App\Console\Commands\Updatetrials',
        '\App\Console\Commands\HourlyUpdate',
        '\App\Console\Commands\TrialAutoNotifications',
		    '\App\Console\Commands\AdsUpdate',
        '\App\Console\Commands\MembershipAutoPayAutoRenew',
        '\App\Console\Commands\MembershipPlanDowngrade',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('UpdateTrials:updatetrials')->everyMinute();
		$schedule->command('HourlyUpdate:sendemails')->everyFiveMinutes();
        $schedule->command('TrialAutoNotifications:trialautonotifications')->everyMinute();
        $schedule->command('AdsUpdate:adsupdate')->everyMinute();
        $schedule->command('MembershipAutoPayAutoRenew:membershipautopayautorenew')->hourly();
        $schedule->command('MembershipPlanDowngrade:membershipplandowngrade')->hourly();
        $schedule->command('TrialPlanExpireNotification:trialplanexpirenotification')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
