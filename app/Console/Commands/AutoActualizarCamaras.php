<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schedule;

class AutoActualizarCamaras extends Command
{
    protected $signature = 'camaras:auto-actualizar';
    protected $description = 'Actualiza cámaras automáticamente cada 5 minutos';

    public function handle()
    {
        $this->info('🔄 Iniciando actualización automática de cámaras...');
        $this->info('Presiona Ctrl+C para detener');

        while (true) {
            $this->call('verificar:camaras');
            $this->info('⏳ Esperando 5 minutos para siguiente verificación...');
            sleep(300); // 5 minutos = 300 segundos
        }
    }
}
