<?php

namespace Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_should_render_login_view_for_guests()
    {
        $response = $this->get('/register');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('auth.register');
    }

    /** @test */
    public function it_should_register_successfully()
    {
        $name = 'name';
        $email = '123@g.com';
        $password = 'password';

        $response = $this->post('/register', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/companies');
    }

    /** @test */
    public function it_should_not_register_with_invalid_fields()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => ''
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /** @test */
    public function it_should_not_register_with_not_unique_email()
    {
        $email = '123@g.com';

        User::factory()->create([
            'email' => $email
        ]);

        $response = $this->post('/register', [
            'name' => 'name',
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['email' => 'The email has already been taken.']);
    }
}
