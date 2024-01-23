<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_should_render_login_view_for_guests()
    {
        $response = $this->get('/login');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function it_should_not_render_login_view_for_loggedInUsers()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/login');

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/companies');
    }

    /** @test */
    public function it_should_login_successfully()
    {
        $email = 'email@g.com';
        $password = 'password';

        User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        $response = $this->post('/login', [
            'email' => $email,
            'password' => $password
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/companies');
    }

    /** @test */
    public function it_should_not_login_with_invalid_email()
    {
        $email = 'email@g.com';
        $password = 'password';
        $invalidEmail = 'invalid@g.com';

        User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        $response = $this->post('/login', [
            'email' => $invalidEmail,
            'password' => 'invalid'
        ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertSessionHasErrors([
            'email' => 'The selected email is invalid.'
        ]);
    }

    /** @test */
    public function it_should_not_login_with_invalid_credentials()
    {
        $email = 'email@g.com';
        $password = 'password';

        User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        $response = $this->post('/login', [
            'email' => $email,
            'password' => 'invalid'
        ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertSessionHasErrors([
            'email' => 'Invalid credentials'
        ]);
    }
}
