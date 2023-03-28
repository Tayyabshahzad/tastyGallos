<?php

namespace App\Console;

use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        Commands\CheckPromotionStatus::class,
    ];
    protected function schedule(Schedule $schedule)
    {
        // $schedule->call(function () {
        //     info(112);
        // })->everyMinute();

       //  $schedule->command('promotion:status')->daily();
         $schedule->command('promotion:status')->everyTenMinutes();
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
