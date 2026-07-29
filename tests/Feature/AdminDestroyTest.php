<?php

namespace Tests\Feature;

use App\Models\Deporte;
use App\Models\Pista;
use App\Models\Superficie;
use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesPartidos;
use Tests\TestCase;

class AdminDestroyTest extends TestCase
{
    use CreatesPartidos;
    use RefreshDatabase;

    public function test_admin_cannot_delete_own_account(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->delete(route('admin.users.destroy', $admin))
            ->assertForbidden();

        $this->assertNotNull($admin->fresh());
    }

    public function test_admin_cannot_delete_another_admin(): void
    {
        $admin = User::factory()->admin()->create();
        $otherAdmin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->delete(route('admin.users.destroy', $otherAdmin))
            ->assertForbidden();

        $this->assertNotNull($otherAdmin->fresh());
    }

    public function test_admin_can_delete_plain_user_without_content(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $this->actingAs($admin)
            ->delete(route('admin.users.destroy', $user))
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas('success');

        $this->assertNull($user->fresh());
    }

    public function test_admin_cannot_delete_user_who_created_partidos(): void
    {
        $this->seedPartidoFixtures();
        $admin = User::factory()->admin()->create();
        $owner = User::factory()->create();
        $this->createFuturePartido($owner);

        $this->actingAs($admin)
            ->delete(route('admin.users.destroy', $owner))
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas('error');

        $this->assertNotNull($owner->fresh());
    }

    public function test_admin_cannot_delete_deporte_with_partidos(): void
    {
        $this->seedPartidoFixtures();
        $admin = User::factory()->admin()->create();
        $owner = User::factory()->create();
        $this->createFuturePartido($owner);

        $deporte = Deporte::findOrFail(2);

        $this->actingAs($admin)
            ->delete(route('admin.deportes.destroy', $deporte))
            ->assertRedirect(route('admin.deportes.index'))
            ->assertSessionHas('error');

        $this->assertNotNull($deporte->fresh());
    }

    public function test_admin_can_delete_unused_deporte(): void
    {
        $admin = User::factory()->admin()->create();
        $deporte = Deporte::create([
            'nombre' => 'Deporte Test',
            'jugadores_por_equipo' => 2,
        ]);

        $this->actingAs($admin)
            ->delete(route('admin.deportes.destroy', $deporte))
            ->assertRedirect(route('admin.deportes.index'))
            ->assertSessionHas('success');

        $this->assertNull($deporte->fresh());
    }

    public function test_admin_cannot_delete_pista_with_partidos(): void
    {
        $this->seedPartidoFixtures();
        $admin = User::factory()->admin()->create();
        $owner = User::factory()->create();
        $this->createFuturePartido($owner);

        $pista = Pista::findOrFail(1);

        $this->actingAs($admin)
            ->delete(route('admin.pista.destroy', $pista))
            ->assertRedirect(route('admin.pista.index'))
            ->assertSessionHas('error');

        $this->assertNotNull($pista->fresh());
    }

    public function test_admin_cannot_delete_ubicacion_with_partidos(): void
    {
        $this->seedPartidoFixtures();
        $admin = User::factory()->admin()->create();
        $owner = User::factory()->create();
        $this->createFuturePartido($owner);

        $ubicacion = Ubicacion::findOrFail(1);

        $this->actingAs($admin)
            ->delete(route('admin.ubicacion.destroy', $ubicacion))
            ->assertRedirect(route('admin.ubicacion.index'))
            ->assertSessionHas('error');

        $this->assertNotNull($ubicacion->fresh());
    }

    public function test_admin_cannot_delete_superficie_with_partidos(): void
    {
        $this->seedPartidoFixtures();
        $admin = User::factory()->admin()->create();
        $owner = User::factory()->create();
        $this->createFuturePartido($owner);

        $superficie = Superficie::findOrFail(1);

        $this->actingAs($admin)
            ->delete(route('admin.superficie.destroy', $superficie))
            ->assertRedirect(route('admin.superficie.index'))
            ->assertSessionHas('error');

        $this->assertNotNull($superficie->fresh());
    }
}
