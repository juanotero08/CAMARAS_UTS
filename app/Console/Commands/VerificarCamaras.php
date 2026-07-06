<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Camara;

class VerificarCamaras extends Command
{
    protected $signature = 'verificar:camaras';
    protected $description = 'Verifica estado de cámaras en bloques de 20';

    public function handle()
    {
        $loteNum = 1;
        \App\Models\Camara::chunk(20, function ($camaras) use (&$loteNum) {
            $this->info("Procesando lote $loteNum con " . count($camaras) . " cámaras...");

            foreach ($camaras as $camara) {
                $this->verificarCamara($camara);
            }

            $loteNum++;
        });

        $this->info('✅ Todas las cámaras verificadas');
    }

    private function verificarCamara(Camara $camara)
    {
        $ip = $camara->ip;
        $conexion = @fsockopen($ip, 554, $errno, $errstr, 2);

        if ($conexion) {
            fclose($conexion);
            $http = @file_get_contents("http://$ip", false, stream_context_create(['http' => ['timeout' => 2]]));
            $camara->estado = $http !== false ? "DISPONIBLE" : "ESPERA";
        } else {
            $camara->estado = "CAIDA";
        }

        $camara->ultima_conexion = now();
        $camara->save();
    }
}