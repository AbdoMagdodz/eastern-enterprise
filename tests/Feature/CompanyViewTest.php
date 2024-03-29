<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;


class CompanyViewTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_should_render_companies_view_for_guests()
    {
        $response = $this->get('/companies');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('companies.index');
    }


    /** @test */
    public function it_should_render_companies_view_for_loggedInUsers()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/companies');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('companies.index');
    }

    /** @test */
    public function it_displays_companies_from_database_in_the_view()
    {
        $company = [
            'name' => 'c',
            'description' => 'This is company A',
            'street' => '123 Main St',
            'country' => 'Country',
            'postal_code' => '12345',
            'phone_number' => '1234567890',
            'logo' => 'logo.png',
            'symbol' => 'META',
        ];

        $companyA = Company::factory()->create([
            ...$company,
            "name" => "Company A",
            'symbol' => 'S1',
        ]);

        $companyB = Company::factory()->create([
            ...$company,
            "name" => "Company B",
            'symbol' => 'S2',
        ]);


        $response = $this->get('/companies');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('companies.index');
        $response->assertSee($companyA->name);
        $response->assertSee($companyB->name);
        $response->assertSee($companyA->description);
        $response->assertSee($companyB->description);
        $response->assertSee($companyA->street);
        $response->assertSee($companyB->street);
        $response->assertSee($companyA->symbol);
        $response->assertSee($companyB->symbol);
        $response->assertSee($companyA->postal_code);
        $response->assertSee($companyB->postal_code);
        $response->assertSee($companyA->phone_number);
        $response->assertSee($companyB->phone_number);
    }
}
