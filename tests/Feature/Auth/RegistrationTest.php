<?php

namespace Tests\Feature\Auth;

<<<<<<< HEAD
=======
use App\Providers\RouteServiceProvider;
>>>>>>> pemasok
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

<<<<<<< HEAD
=======
    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

>>>>>>> pemasok
    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
<<<<<<< HEAD
        $response->assertNoContent();
=======
        $response->assertRedirect(RouteServiceProvider::HOME);
>>>>>>> pemasok
    }
}
