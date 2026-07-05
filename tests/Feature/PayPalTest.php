<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\Concerns\CreatesPartidos;
use Tests\TestCase;

class PayPalTest extends TestCase
{
    use CreatesPartidos;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.paypal.client_id' => 'test-client',
            'services.paypal.client_secret' => 'test-secret',
            'services.paypal.mode' => 'sandbox',
        ]);

        Cache::forget('paypal_access_token');
    }

    public function test_owner_can_start_paypal_redirect(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $partido = $this->createFuturePartido($owner);

        Http::fake([
            'api-m.sandbox.paypal.com/v1/oauth2/token' => Http::response(['access_token' => 'fake-token'], 200),
            'api-m.sandbox.paypal.com/v2/checkout/orders' => Http::response([
                'id' => 'ORDER123',
                'links' => [
                    ['rel' => 'approve', 'href' => 'https://sandbox.paypal.com/checkout?token=ORDER123'],
                ],
            ], 201),
        ]);

        $this->actingAs($owner)
            ->get(route('paypal.start', $partido))
            ->assertRedirect('https://sandbox.paypal.com/checkout?token=ORDER123');
    }

    public function test_non_owner_cannot_start_paypal(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $partido = $this->createFuturePartido($owner);

        $this->actingAs($other)
            ->get(route('paypal.start', $partido))
            ->assertForbidden();
    }

    public function test_paypal_cancel_returns_to_partido(): void
    {
        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $partido = $this->createFuturePartido($owner);

        $this->actingAs($owner)
            ->get(route('paypal.cancel', $partido))
            ->assertRedirect(route('partidos.show', $partido))
            ->assertSessionHas('info');
    }

    public function test_paypal_not_configured_shows_error(): void
    {
        config(['services.paypal.client_id' => null, 'services.paypal.client_secret' => null]);

        $this->seedPartidoFixtures();
        $owner = User::factory()->create();
        $partido = $this->createFuturePartido($owner);

        $this->actingAs($owner)
            ->from(route('partidos.show', $partido))
            ->get(route('paypal.start', $partido))
            ->assertRedirect(route('partidos.show', $partido))
            ->assertSessionHas('error');
    }
}
