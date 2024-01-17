<?php

use App\Livewire\Company\CompanyTable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CompanyTableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_renders_company_table_component()
    {
        // Arrange: Mock the CompanyUseCase with expectations
        $companyUseCaseMock = $this->mock(\App\Core\UseCases\Company\CompanyUseCase::class);
        $companyUseCaseMock->shouldReceive('getAll')->once()->andReturn([]);

        // Act
        Livewire::test(CompanyTable::class)
            ->assertSee('Name')
            ->assertSee('Symbol')
            ->assertSee('Logo')
            ->assertSee('Description')
            ->assertSee('Address');

        // Assert
        $companyUseCaseMock->shouldHaveReceived('getAll')->once();

        // Assert
        $companyUseCaseMock->shouldHaveReceived('getAll')->once();
    }
}
