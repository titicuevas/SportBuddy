<?php

namespace Tests\Feature;

use App\Models\Pista;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPistaTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_pista_with_precio_con_luz_sets_tiene_luz(): void
    {
        $admin = User::factory()->admin()->create();
        $pistaDraft = Pista::factory()->make([
            'numero' => 1,
            'precio_sin_luz' => 20,
            'precio_con_luz' => 30,
        ]);

        $this->actingAs($admin)
            ->post(route('admin.pista.store'), [
                'ubicacion_id' => $pistaDraft->ubicacion_id,
                'superficie_id' => $pistaDraft->superficie_id,
                'deporte_id' => $pistaDraft->deporte_id,
                'numero' => $pistaDraft->numero,
                'precio_sin_luz' => $pistaDraft->precio_sin_luz,
                'precio_con_luz' => $pistaDraft->precio_con_luz,
            ])
            ->assertRedirect(route('admin.pista.index'))
            ->assertSessionHas('success');

        $pista = Pista::query()->firstOrFail();

        $this->assertTrue($pista->tiene_luz);
        $this->assertSame('30.00', $pista->precio_con_luz);
    }

    public function test_updating_pista_clears_tiene_luz_without_precio_con_luz(): void
    {
        $admin = User::factory()->admin()->create();
        $pista = Pista::factory()->create([
            'numero' => 1,
            'precio_sin_luz' => 20,
            'precio_con_luz' => 30,
        ]);

        $this->assertTrue($pista->fresh()->tiene_luz);

        $this->actingAs($admin)
            ->put(route('admin.pista.update', $pista), [
                'ubicacion_id' => $pista->ubicacion_id,
                'superficie_id' => $pista->superficie_id,
                'deporte_id' => $pista->deporte_id,
                'numero' => $pista->numero,
                'precio_sin_luz' => 20,
                'precio_con_luz' => null,
            ])
            ->assertRedirect(route('admin.pista.index'));

        $pista->refresh();

        $this->assertFalse($pista->tiene_luz);
        $this->assertNull($pista->precio_con_luz);
    }

    public function test_pista_api_exposes_tiene_luz(): void
    {
        $user = User::factory()->create();
        $pista = Pista::factory()->create([
            'numero' => 3,
            'precio_sin_luz' => 15,
            'precio_con_luz' => 22,
        ]);

        $this->actingAs($user)
            ->get(route('pistas.show', $pista))
            ->assertOk()
            ->assertJson([
                'tiene_luz' => true,
                'precio_con_luz' => '22.00',
                'deporte' => $pista->deporte->nombre,
            ]);
    }
}
