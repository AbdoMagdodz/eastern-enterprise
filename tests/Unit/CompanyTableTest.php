<?php

use App\Livewire\Company\CompanyTable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Domain\Company\UseCase\CompanyUseCase;

class CompanyTableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_renders_company_table_component()
    {
        $companyUseCaseMock = $this->mock(CompanyUseCase::class);
        $companyUseCaseMock->shouldReceive('getAll')->once()->andReturn([]);

        Livewire::test(CompanyTable::class)
            ->assertSee('Name')
            ->assertSee('Symbol')
            ->assertSee('Logo')
            ->assertSee('Description')
            ->assertSee('Address')
            ->assertSee('Phone Number')
            ->assertSee('Postal Code')
            ->assertSee('Logo')
            ->assertSee('Action');

        $companyUseCaseMock->shouldHaveReceived('getAll')->once();
    }
}
