<?php

namespace App\Livewire\Company;

use App\Domain\Company\UseCase\CompanyUseCase;
use Livewire\Component;
use Livewire\Attributes\On;

class CompanyDetailsModal extends Component
{
    /**
     * @var CompanyUseCase
     */
    private CompanyUseCase $companyUseCase;

    /**
     * @var string
     */
    public string $companySymbol = '';

    /**
     * @param CompanyUseCase $companyUseCase
     */
    public function boot(CompanyUseCase $companyUseCase): void
    {
        $this->companyUseCase = $companyUseCase;
    }

    /**
     * @param CompanyUseCase $companyUseCase
     */
    public function mount(CompanyUseCase $companyUseCase): void
    {
        $this->companyUseCase = $companyUseCase;
    }

    /**
     * @return view
     */
    public function render()
    {
        $stockData = $this->companySymbol === '' ? [] : $this->companyUseCase->getCompanyStockData($this->companySymbol);

        $limitExceededMessage = $stockData['Information'] ?? null;

        return view('livewire.company.company-details-modal', compact('stockData', 'limitExceededMessage'));
    }

    /**
     * @param string $symbol
     */
    public function openModal(string $symbol): void
    {
        $this->companySymbol = $symbol;
    }

    /**
     * @param string $symbol
     * @return void
     */
    #[On('showCompanyDetails')]
    public function showCompanyDetails(string $symbol): void
    {
        $this->companySymbol = $symbol;
    }
}
