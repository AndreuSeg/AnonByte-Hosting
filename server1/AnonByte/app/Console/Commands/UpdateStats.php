<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza en la vista la salida de la funcion stats()';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Aquí llamamos a la función stats() del controlador DashboardController
        $stats = app()->make('App\Http\Controllers\DashboardController')->stats();
        $this->info('Estadísticas actualizadas: ' . $stats);
        // return Command::SUCCESS;
    }
}
