<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $this->get('/register')->assertOk();
    }

    public function test_new_users_can_register_when_auto_verify_is_enabled(): void
    {
        config(['app.auto_verify_email' => true]);

        $response = $this->post('/register', [
            'name' => 'Test',
            'apellidos' => 'Usuario',
            'telefono' => '612345678',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertNotNull(auth()->user()->email_verified_at);
    }

    public function test_new_users_must_verify_email_when_auto_verify_is_disabled(): void
    {
        config(['app.auto_verify_email' => false]);

        $response = $this->post('/register', [
            'name' => 'Test',
            'apellidos' => 'Usuario',
            'telefono' => '612345678',
            'email' => 'nuevo@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('verification.notice'));
        $this->assertNull(auth()->user()->email_verified_at);
    }
}
