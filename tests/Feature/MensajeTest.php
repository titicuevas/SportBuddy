<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesPartidos;
use Tests\TestCase;

class MensajeTest extends TestCase
{
    use CreatesPartidos;
    use RefreshDatabase;

    public function test_guests_cannot_access_partido_chat(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $partido = $this->createFuturePartido($owner);

        $this->get(route('mensajes.index', $partido))
            ->assertRedirect(route('login'));
    }

    public function test_non_enrolled_user_cannot_access_chat(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $stranger = User::factory()->create();
        $partido = $this->createFuturePartido($owner);

        $this->actingAs($stranger)
            ->get(route('mensajes.index', $partido))
            ->assertForbidden();
    }

    public function test_enrolled_user_can_view_and_post_messages(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $player = User::factory()->create();
        $partido = $this->createFuturePartido($owner);
        $this->enrollUserInPartido($player, $partido);

        $this->actingAs($player)
            ->get(route('mensajes.index', $partido))
            ->assertOk()
            ->assertSee('Chat del partido');

        $this->actingAs($player)
            ->post(route('mensajes.store', $partido), [
                'contenido' => 'Nos vemos en la pista',
            ])
            ->assertRedirect(route('mensajes.index', $partido));

        $this->actingAs($player)
            ->get(route('mensajes.index', $partido))
            ->assertSee('Nos vemos en la pista');
    }

    public function test_partido_creator_can_access_chat_without_enrolling(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $partido = $this->createFuturePartido($owner);

        $this->actingAs($owner)
            ->get(route('mensajes.index', $partido))
            ->assertOk();
    }
}
