<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;
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
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/companies', [
            'name' => 'Example Company',
            'symbol' => 'EXM',
            'address' => '123 Main St',
            'description' => 'A description of the company.',
        ]);

        // Assert
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/');
    }

    /** @test */
    public function it_validates_uniqueness_of_company_symbol()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Company::factory()->create(['symbol' => 'ABC']);

        $response = $this->post('/companies', [
            'name' => 'Duplicate Company',
            'symbol' => 'ABC',
            'logo' => UploadedFile::fake()->create('document.png', 1024),
            'description' => 'Another description',
            'address' => 'Another address',
        ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertSame("The symbol has already been taken.", $response->exception->getMessage());
    }
}
