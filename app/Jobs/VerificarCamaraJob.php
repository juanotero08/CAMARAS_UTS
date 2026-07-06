<?php

namespace App\Jobs;

use App\Models\Camara;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class VerificarCamaraJob implements ShouldQueue
{
    use Queueable;

    protected $camara;

    // 🔥 AQUÍ RECIBES LA CÁMARA
    public function __construct(Camara $camara)
    {
        $this->camara = $camara;
    }

    // 🔥 AQUÍ HACES LA LÓGICA
    public function handle()
{
    $ip = $this->camara->ip;

    // 1. Probar RTSP
    $conexion = @fsockopen($ip, 554, $errno, $errstr, 2);

    if ($conexion) {
        fclose($conexion);

        // 2. Verificar HTTP
        $http = @file_get_contents("http://$ip");

        if ($http !== false) {
            $this->camara->estado = "DISPONIBLE";
        } else {
            $this->camara->estado = "ESPERA";
        }

    } else {
        $this->camara->estado = "CAIDA";
    }

    $this->camara->ultima_conexion = now();
    $this->camara->save();
}
}