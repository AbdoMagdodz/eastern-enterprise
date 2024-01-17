<?php

namespace App\Livewire\Company;

use Livewire\Component;
use App\Core\UseCases\Company\CompanyUseCase;

class CompanyTable extends Component
{
    private CompanyUseCase $companyUseCase;

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
        $companies = $this->companyUseCase->getAll();

        return view('livewire.company.company-table', compact('companies'));
    }

    /**
     * @param string $symbol
     * @return void
     * @emits showCompanyDetails
     */
    public function showDetails(string $symbol)
    {
        $this->dispatch('showCompanyDetails', symbol: $symbol);
    }
}
