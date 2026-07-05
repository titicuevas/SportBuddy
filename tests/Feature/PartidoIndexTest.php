<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\Concerns\CreatesPartidos;
use Tests\TestCase;

class PartidoIndexTest extends TestCase
{
    use CreatesPartidos;
    use RefreshDatabase;

    public function test_guests_are_redirected_from_partidos_index(): void
    {
        $this->get(route('partidos.index'))
            ->assertRedirect(route('login'));
    }

    public function test_unverified_users_are_redirected_from_partidos_index(): void
    {
        $user = User::factory()->unverified()->create();

        $this->actingAs($user)
            ->get(route('partidos.index'))
            ->assertRedirect(route('verification.notice'));
    }

    public function test_verified_users_can_access_partidos_index(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('partidos.index'))
            ->assertOk();
    }

    public function test_enrolled_partidos_are_excluded_from_available_list(): void
    {
        $this->seedPartidoFixtures();

        $owner = User::factory()->create();
        $player = User::factory()->create();
        $partido = $this->createFuturePartido($owner);
        $this->enrollUserInPartido($owner, $partido, 1);

        $this->actingAs($player)
            ->get(route('partidos.index'))
            ->assertViewHas('partidos', fn ($partidos) => $partidos->contains('id', $partido->id))
            ->assertViewHas('partidosInscritos', fn ($inscritos) => $inscritos->isEmpty());

        $this->enrollUserInPartido($player, $partido, 2);
        Cache::put('partidos.cache.version', (int) Cache::get('partidos.cache.version', 1) + 1);

        $this->actingAs($player)
            ->get(route('partidos.index'))
            ->assertViewHas('partidos', fn ($partidos) => $partidos->isEmpty())
            ->assertViewHas('partidosInscritos', fn ($inscritos) => $inscritos->contains('id', $partido->id));
    }
}
