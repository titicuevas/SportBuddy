<?php

namespace Tests\Feature;

use App\Models\Pista;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesPartidos;
use Tests\TestCase;

class PartidoStoreTest extends TestCase
{
    use CreatesPartidos;
    use RefreshDatabase;

    public function test_user_can_create_partido_with_pista_light_snapshot(): void
    {
        $this->seedPartidoFixtures();
        $user = User::factory()->create();
        $pista = Pista::findOrFail(1);

        $fecha = now()->addDays(2)->format('Y-m-d');
        $hora = '20:00';

        $this->actingAs($user)
            ->post(route('partidos.store'), [
                'fecha' => $fecha,
                'hora' => $hora,
                'ubicacion_id' => $pista->ubicacion_id,
                'pista_id' => $pista->id,
                'deporte' => $pista->deporte->nombre,
                'tipo_superficie' => $pista->superficie->tipo,
                'precio' => $pista->precio_sin_luz,
            ])
            ->assertRedirect(route('partidos.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('partidos', [
            'user_id' => $user->id,
            'pista_id' => $pista->id,
            'pista_tiene_luz' => $pista->tiene_luz,
        ]);
    }

    public function test_cannot_create_partido_in_the_past_today(): void
    {
        $this->seedPartidoFixtures();
        $user = User::factory()->create();
        $pista = Pista::with(['deporte', 'superficie'])->findOrFail(1);

        $this->actingAs($user)
            ->from(route('partidos.create'))
            ->post(route('partidos.store'), [
                'fecha' => now()->format('Y-m-d'),
                'hora' => now()->subHour()->format('H:i'),
                'ubicacion_id' => $pista->ubicacion_id,
                'pista_id' => $pista->id,
                'deporte' => $pista->deporte->nombre,
                'tipo_superficie' => $pista->superficie->tipo,
                'precio' => $pista->precio_sin_luz,
            ])
            ->assertRedirect(route('partidos.create'))
            ->assertSessionHasErrors('hora');
    }

    public function test_cannot_create_partido_with_invalid_precio(): void
    {
        $this->seedPartidoFixtures();
        $user = User::factory()->create();
        $pista = Pista::with(['deporte', 'superficie'])->findOrFail(1);

        $this->actingAs($user)
            ->from(route('partidos.create'))
            ->post(route('partidos.store'), [
                'fecha' => now()->addDays(2)->format('Y-m-d'),
                'hora' => '20:00',
                'ubicacion_id' => $pista->ubicacion_id,
                'pista_id' => $pista->id,
                'deporte' => $pista->deporte->nombre,
                'tipo_superficie' => $pista->superficie->tipo,
                'precio' => 999,
            ])
            ->assertRedirect(route('partidos.create'))
            ->assertSessionHasErrors('precio');
    }
}
