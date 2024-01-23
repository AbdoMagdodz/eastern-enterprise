<?php

namespace App\Http\Controllers;

use App\Domain\Company\UseCase\CompanyUseCase;
use App\Http\Requests\CreateCompanyRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{
    /**
     * @param CompanyUseCase $companyUseCase
     */
    public function __construct(private readonly CompanyUseCase $companyUseCase)
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('companies.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('companies.create');
    }

    /**
     * @param CreateCompanyRequest $request
     * @return RedirectResponse
     */
    public function store(CreateCompanyRequest $request): RedirectResponse
    {
        $this->companyUseCase->createCompany($request->validated());

        return redirect()->route('companies.index');
    }
}
