<?php

namespace Tests\Feature;

use App\Models\Comentario;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesPartidos;
use Tests\TestCase;

class ComentarioTest extends TestCase
{
    use CreatesPartidos;
    use RefreshDatabase;

    public function test_enrolled_user_can_post_comment_to_route_partido(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $player = User::factory()->create();
        $partido = $this->createFuturePartido($owner);
        $this->enrollUserInPartido($player, $partido);

        $response = $this->actingAs($player)
            ->post(route('comentarios.store', $partido), [
                'contenido' => 'Llego 10 minutos antes.',
            ]);

        $response->assertOk();
        $response->assertSee('Llego 10 minutos antes.');

        $this->assertDatabaseHas('comentarios', [
            'partido_id' => $partido->id,
            'user_id' => $player->id,
            'contenido' => 'Llego 10 minutos antes.',
        ]);
    }

    public function test_comment_uses_partido_from_url_instead_of_request_body(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $player = User::factory()->create();
        $otroPartido = $this->createFuturePartido($owner);
        $partidoDestino = $this->createFuturePartido($owner);
        $this->enrollUserInPartido($player, $partidoDestino);

        $this->actingAs($player)
            ->post(route('comentarios.store', $partidoDestino), [
                'partido_id' => $otroPartido->id,
                'contenido' => 'Comentario ligado a la URL.',
            ])
            ->assertOk();

        $comentario = Comentario::query()->where('contenido', 'Comentario ligado a la URL.')->firstOrFail();

        $this->assertSame($partidoDestino->id, $comentario->partido_id);
    }
}
