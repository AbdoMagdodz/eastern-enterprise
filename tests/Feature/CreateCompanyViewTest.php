<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;


class CreateCompanyViewTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_displays_create_company_form()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/companies/create');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee('Create Company');
        $response->assertSee('Name');
        $response->assertSee('Symbol');
        $response->assertSee('Street');
        $response->assertSee('Country');
        $response->assertSee('Postal Code');
        $response->assertSee('Phone Number');
        $response->assertSee('Description');
        $response->assertSee('Logo');
        $response->assertSee('Create');
    }

    /** @test */
    public function it_allows_authenticated_users_to_access_create_page()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/companies/create');

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_redirects_unauthenticated_users_from_create_page()
    {
        $response = $this->get('/companies/create');

        $response->assertRedirect('/login');
    }
}
