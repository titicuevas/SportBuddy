<?php

namespace App\Services;

use App\Models\Partido;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class PayPalService
{
    public function isConfigured(): bool
    {
        return filled(config('services.paypal.client_id'))
            && filled(config('services.paypal.client_secret'));
    }

    protected function baseUrl(): string
    {
        return config('services.paypal.mode') === 'live'
            ? 'https://api-m.paypal.com'
            : 'https://api-m.sandbox.paypal.com';
    }

    protected function accessToken(): string
    {
        return Cache::remember('paypal_access_token', 3000, function () {
            $response = Http::withBasicAuth(
                config('services.paypal.client_id'),
                config('services.paypal.client_secret')
            )->asForm()->post($this->baseUrl().'/v1/oauth2/token', [
                'grant_type' => 'client_credentials',
            ]);

            if ($response->failed()) {
                throw new RuntimeException('No se pudo autenticar con PayPal.');
            }

            return $response->json('access_token');
        });
    }

    public function createOrder(Partido $partido): array
    {
        $response = Http::withToken($this->accessToken())
            ->post($this->baseUrl().'/v2/checkout/orders', [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'reference_id' => 'partido_'.$partido->id,
                    'description' => 'Reserva pista - Partido #'.$partido->id,
                    'amount' => [
                        'currency_code' => 'EUR',
                        'value' => number_format((float) $partido->precio, 2, '.', ''),
                    ],
                ]],
                'application_context' => [
                    'brand_name' => config('app.name', 'SportBuddy'),
                    'locale' => 'es-ES',
                    'landing_page' => 'LOGIN',
                    'user_action' => 'PAY_NOW',
                    'return_url' => route('paypal.return', $partido),
                    'cancel_url' => route('paypal.cancel', $partido),
                ],
            ]);

        if ($response->failed()) {
            throw new RuntimeException('No se pudo crear la orden de PayPal.');
        }

        return $response->json();
    }

    public function captureOrder(string $orderId): array
    {
        $response = Http::withToken($this->accessToken())
            ->post($this->baseUrl().'/v2/checkout/orders/'.$orderId.'/capture');

        if ($response->failed()) {
            throw new RuntimeException('No se pudo capturar el pago de PayPal.');
        }

        return $response->json();
    }

    public function verifyCaptureForPartido(array $capture, Partido $partido): bool
    {
        if (($capture['status'] ?? '') !== 'COMPLETED') {
            return false;
        }

        $purchaseUnit = $capture['purchase_units'][0] ?? [];
        $referenceId = $purchaseUnit['reference_id'] ?? '';

        if ($referenceId !== 'partido_'.$partido->id) {
            return false;
        }

        $paidAmount = $purchaseUnit['payments']['captures'][0]['amount']['value'] ?? null;
        $expected = number_format((float) $partido->precio, 2, '.', '');

        return $paidAmount !== null && bccomp((string) $paidAmount, $expected, 2) === 0;
    }
}
