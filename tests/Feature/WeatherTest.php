<?php

namespace Tests\Feature;

use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\Concerns\CreatesPartidos;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    use CreatesPartidos;
    use RefreshDatabase;

    public function test_clima_endpoint_returns_weather_when_configured(): void
    {
        $this->seedPartidoFixtures();
        config(['services.openweather.api_key' => 'test-key']);

        Http::fake([
            'api.openweathermap.org/*' => Http::response([
                'main' => ['temp' => 22.4, 'feels_like' => 21.0, 'humidity' => 60],
                'weather' => [['description' => 'cielo claro', 'icon' => '01d']],
                'wind' => ['speed' => 3.2],
            ], 200),
        ]);

        $user = User::factory()->create();
        $partido = $this->createFuturePartido($user);
        $partido->update(['fecha_hora' => now()->addHours(2)]);

        $this->actingAs($user)
            ->getJson(route('partidos.clima', $partido))
            ->assertOk()
            ->assertJsonPath('available', true)
            ->assertJsonPath('temp', 22)
            ->assertJsonPath('description', 'Cielo claro');
    }

    public function test_clima_returns_not_configured_without_api_key(): void
    {
        config(['services.openweather.api_key' => null]);

        $this->seedPartidoFixtures();
        $user = User::factory()->create();
        $partido = $this->createFuturePartido($user);

        $this->actingAs($user)
            ->getJson(route('partidos.clima', $partido))
            ->assertOk()
            ->assertJsonPath('configured', false);
    }

    public function test_clima_ubicacion_endpoint_works(): void
    {
        $this->seedPartidoFixtures();
        config(['services.openweather.api_key' => 'test-key']);

        Http::fake([
            'api.openweathermap.org/*' => Http::response([
                'main' => ['temp' => 18.0, 'feels_like' => 17.0, 'humidity' => 70],
                'weather' => [['description' => 'nubes dispersas', 'icon' => '03d']],
                'wind' => ['speed' => 2.1],
            ], 200),
        ]);

        $ubicacion = Ubicacion::query()->firstOrFail();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->getJson(route('ubicaciones.clima', $ubicacion))
            ->assertOk()
            ->assertJsonPath('available', true);
    }
}
