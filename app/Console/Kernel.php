<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\VerificarCamaras::class,
        \App\Console\Commands\AutoActualizarCamaras::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('verificar:camaras')->everyFiveMinutes();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}