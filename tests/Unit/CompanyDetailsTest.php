<?php

namespace Tests\Unit;

use App\Domain\Company\Infrastructure\CompanyRepository;
use App\Domain\Company\Infrastructure\ExternalServices\AlphavantageStockService;
use App\Livewire\Company\CompanyDetailsModal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Domain\Company\UseCase\CompanyUseCase;

class CompanyDetailsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_renders_company_details_modal_component()
    {
        $stockServiceMock = $this->createMock(AlphavantageStockService::class);

        $companyUseCase = new CompanyUseCase($this->createMock(CompanyRepository::class), $stockServiceMock);

        Livewire::test(CompanyDetailsModal::class, ['companyUseCase' => $companyUseCase])
            ->assertSee('NASDAQ Information for')
            ->assertSee('Open Price')
            ->assertSee('High Price')
            ->assertSee('Low Price')
            ->assertSee('Prev Close')
            ->assertSee('Latest Price');

        $this->assertTrue(true);
    }
}
