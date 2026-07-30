<?php

namespace Tests\Feature;

use App\Models\Asignamiento;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesPartidos;
use Tests\TestCase;

class PartidoInscripcionTest extends TestCase
{
    use CreatesPartidos;
    use RefreshDatabase;

    public function test_user_can_enroll_in_partido(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $player = User::factory()->create();
        $partido = $this->createFuturePartido($owner);

        $this->actingAs($player)
            ->post(route('partidos.inscribirse', $partido))
            ->assertRedirect();

        $this->assertDatabaseHas('asignamientos', [
            'partido_id' => $partido->id,
            'user_id' => $player->id,
        ]);
    }

    public function test_enrolled_non_owner_can_unenroll(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $player = User::factory()->create();
        $partido = $this->createFuturePartido($owner);
        $this->enrollUserInPartido($player, $partido);

        $this->actingAs($player)
            ->from(route('partidos.show', $partido))
            ->post(route('partidos.desapuntarse', $partido))
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('asignamientos', [
            'partido_id' => $partido->id,
            'user_id' => $player->id,
        ]);
    }

    public function test_owner_cannot_unenroll(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $partido = $this->createFuturePartido($owner);
        $this->enrollUserInPartido($owner, $partido);

        $this->actingAs($owner)
            ->post(route('partidos.desapuntarse', $partido))
            ->assertForbidden();

        $this->assertDatabaseHas('asignamientos', [
            'partido_id' => $partido->id,
            'user_id' => $owner->id,
        ]);
    }

    public function test_non_enrolled_user_cannot_unenroll(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $partido = $this->createFuturePartido($owner);

        $this->actingAs($other)
            ->post(route('partidos.desapuntarse', $partido))
            ->assertForbidden();
    }

    public function test_only_owner_can_delete_partido(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $partido = $this->createFuturePartido($owner);

        $this->actingAs($other)
            ->delete(route('partidos.destroy', $partido))
            ->assertForbidden();

        $this->actingAs($owner)
            ->delete(route('partidos.destroy', $partido))
            ->assertRedirect(route('partidos.index'));

        $this->assertDatabaseMissing('partidos', ['id' => $partido->id]);
        $this->assertSame(0, Asignamiento::where('partido_id', $partido->id)->count());
    }

    public function test_cannot_enroll_in_past_partido(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $player = User::factory()->create();
        $partido = $this->createPastPartido($owner);

        $this->actingAs($player)
            ->post(route('partidos.inscribirse', $partido))
            ->assertForbidden();

        $this->assertDatabaseMissing('asignamientos', [
            'partido_id' => $partido->id,
            'user_id' => $player->id,
        ]);
    }
}
