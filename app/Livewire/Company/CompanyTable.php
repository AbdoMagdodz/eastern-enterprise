<?php

namespace App\Livewire\Company;

use App\Domain\Company\UseCase\CompanyUseCase;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CompanyTable extends Component
{
    /**
     * @var CompanyUseCase
     */
    private CompanyUseCase $companyUseCase;

    /**
     * @param CompanyUseCase $companyUseCase
     * @return void
     */
    public function boot(CompanyUseCase $companyUseCase): void
    {
        $this->companyUseCase = $companyUseCase;
    }

    /**
     * @return View
     */
    public function render()
    {
        $companies = $this->companyUseCase->getAll();

        return view('livewire.company.company-table', compact('companies'));
    }

    /**
     * @param string $symbol
     * @return void
     */
    public function showDetails(string $symbol): void
    {
        $this->dispatch('showCompanyDetails', symbol: $symbol);
    }
}
