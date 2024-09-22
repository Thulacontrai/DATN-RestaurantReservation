<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('reservations:check-status')->everyMinute();
<<<<<<< HEAD
        $schedule->command('reservation:check')->everyFifteenMinutes();

=======
>>>>>>> a12e744211bdba5324b3b28a9ea438108c708317
    }


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }



}
