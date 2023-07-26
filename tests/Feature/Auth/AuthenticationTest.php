<?php

namespace Tests\Feature\Auth;

use App\Models\User;
<<<<<<< HEAD
=======
use App\Providers\RouteServiceProvider;
>>>>>>> pemasok
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

<<<<<<< HEAD
=======
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

>>>>>>> pemasok
    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
<<<<<<< HEAD
        $response->assertNoContent();
=======
        $response->assertRedirect(RouteServiceProvider::HOME);
>>>>>>> pemasok
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
