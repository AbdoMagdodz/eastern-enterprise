<?php

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateCompanyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_shows_validation_errors_in_the_view()
    {
        // Arrange: Create an authenticated user
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        // Act
        $response = $this->post('/companies', [
            'name' => '',
            'symbol' => '',
            'address' => '',
            'description' => '',
            'logo' => '',
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['name', 'symbol', 'address', 'description', 'logo']);
    }

    /** @test */
    public function it_submits_form_successfully()
    {
        // Arrange: Create an authenticated user
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        // Act
        $response = $this->post('/companies', [
            'name' => 'Example Company',
            'symbol' => 'EXM',
            'address' => '123 Main St',
            'description' => 'A description of the company.',
            // Add other valid data based on your form requirements
        ]);

        // Assert
        $response->assertStatus(Response::HTTP_FOUND); // Check for a redirect
        $response->assertRedirect('/'); // Adjust the redirect path if needed
    }
}
