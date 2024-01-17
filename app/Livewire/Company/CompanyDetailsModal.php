<?php

namespace App\Livewire\Company;

use Livewire\Component;
use App\Core\UseCases\Company\CompanyUseCase;
use Livewire\Attributes\On;


class CompanyDetailsModal extends Component
{
    private CompanyUseCase $companyUseCase;

    public string $companySymbol = '';

    /**
     * @param CompanyUseCase
     */
    public function boot(CompanyUseCase $companyUseCase)
    {
        $this->companyUseCase = $companyUseCase;
    }

    /**
     * @return view
     */
    public function render()
    {
        $stockData = $this->companySymbol === '' ? [] : $this->companyUseCase->getCompanyStockData($this->companySymbol);

        return view('livewire.company.company-details-modal', compact('stockData'));
    }

    /**
     * @param string $symbol
     */
    public function openModal(string $symbol)
    {
        $this->companySymbol = $symbol;
    }

    /**
     * @param string $symbol
     * @return void
     */
    #[On('showCompanyDetails')]
    public function showCompanyDetails(string $symbol)
    {
        $this->companySymbol = $symbol;
    }
}
