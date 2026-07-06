<?php

namespace Tests\Feature;

use App\Models\Camara;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_cameras_list_orders_ips_by_full_numeric_value(): void
    {
        $user = User::factory()->create();

        Camara::create([
            'nombre' => 'Camara 1',
            'ip' => '192.168.100.100',
            'ubicacion' => 'Sala',
            'estado' => 'DISPONIBLE',
        ]);

        Camara::create([
            'nombre' => 'Camara 2',
            'ip' => '192.168.100.99',
            'ubicacion' => 'Sala',
            'estado' => 'DISPONIBLE',
        ]);

        Camara::create([
            'nombre' => 'Camara 3',
            'ip' => '192.168.100.10',
            'ubicacion' => 'Sala',
            'estado' => 'DISPONIBLE',
        ]);

        $response = $this->actingAs($user)->get('/camaras?sort=ip_asc');

        $response->assertOk();
        $response->assertSeeInOrder([
            '192.168.100.10',
            '192.168.100.99',
            '192.168.100.100',
        ]);
    }
}
