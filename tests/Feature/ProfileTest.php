<?php

namespace Tests\Feature;

use App\Models\Mensaje;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesPartidos;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use CreatesPartidos;
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'apellidos' => $user->apellidos,
                'telefono' => $user->telefono,
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertSame('Test User', $user->refresh()->name);
    }

    public function test_changing_email_requires_reverification(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => $user->name,
                'apellidos' => $user->apellidos,
                'telefono' => $user->telefono,
                'email' => 'nuevo@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('verification.notice'));

        $user->refresh();

        $this->assertSame('nuevo@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_profile_phone_must_have_nine_digits(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->patch('/profile', [
                'name' => $user->name,
                'apellidos' => $user->apellidos,
                'telefono' => '12345',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasErrors('telefono')
            ->assertRedirect('/profile');
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'apellidos' => $user->apellidos,
                'telefono' => $user->telefono,
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_user_can_delete_account_that_created_partidos_with_messages(): void
    {
        $this->seedPartidoFixtures();

        $owner = User::factory()->create();
        $other = User::factory()->create();
        $partido = $this->createFuturePartido($owner);
        $this->enrollUserInPartido($owner, $partido);
        $this->enrollUserInPartido($other, $partido, $partido->ladoVisitante());

        Mensaje::create([
            'contenido' => 'Nos vemos en la pista',
            'user_id' => $other->id,
            'partido_id' => $partido->id,
        ]);

        $this->actingAs($owner)
            ->delete('/profile', ['password' => 'password'])
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($owner->fresh());
        $this->assertDatabaseMissing('partidos', ['id' => $partido->id]);
        $this->assertDatabaseMissing('mensajes', ['partido_id' => $partido->id]);
        $this->assertNotNull($other->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
}
