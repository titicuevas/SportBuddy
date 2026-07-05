<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesPartidos;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use CreatesPartidos;
    use RefreshDatabase;

    public function test_guests_are_redirected_from_dashboard(): void
    {
        $this->get(route('dashboard'))
            ->assertRedirect(route('login'));
    }

    public function test_verified_users_can_access_dashboard_with_stats(): void
    {
        $this->seedPartidoFixtures();

        $user = User::factory()->create();
        $partido = $this->createFuturePartido($user);
        $this->enrollUserInPartido($user, $partido);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Mis partidos')
            ->assertSee('Partidos abiertos')
            ->assertSee('Próximos partidos')
            ->assertSee('Polideportivo')
            ->assertViewHas('misPartidos', 1)
            ->assertViewHas('totalDisponibles', 1);
    }
}
