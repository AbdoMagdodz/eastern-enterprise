<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
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
        $user = User::factory()->create();
        $this->actingAs($user);

        // Act
        $response = $this->post('/companies', [
            'name' => '',
            'symbol' => '',
            'street' => '',
            'country' => '',
            'postal_code' => '',
            'phone_number' => '',
            'description' => '',
            'logo' => '',
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors(['name', 'symbol', 'street', 'country', 'postal_code', 'phone_number','description', 'logo']);
    }

    /** @test */
    public function it_submits_form_successfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/companies', [
            'name' => 'Example Company',
            'symbol' => 'EXM',
            'street' => '123 Main St',
            'country' => 'Country',
            'postal_code' => '12345',
            'phone_number' => '1234567890',
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
            'street' => 'Another address',
            'country' => 'Another country',
            'postal_code' => '12345',
            'phone_number' => '1234567890',
        ]);

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertSame("The symbol has already been taken.", $response->exception->getMessage());
    }
}
