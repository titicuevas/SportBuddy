<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_create_forms_render_with_new_layout(): void
    {
        $admin = User::factory()->create(['rol_id' => 1]);

        $routes = [
            route('admin.deportes.create'),
            route('admin.superficie.create'),
            route('admin.ubicacion.create'),
            route('admin.pista.create'),
        ];

        foreach ($routes as $url) {
            $this->actingAs($admin)
                ->get($url)
                ->assertOk()
                ->assertSee('Volver al listado', false);
        }
    }
}
