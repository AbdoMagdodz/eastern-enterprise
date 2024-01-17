<?php

namespace App\Http\Controllers;

use App\Core\UseCases\Company\CompanyUseCase;
use App\Http\Requests\CreateCompanyRequest;

class CompanyController extends Controller
{
    /**
     * @constructor
     * @param CompanyUseCase
     */
    public function __construct(private CompanyUseCase $companyUseCase)
    {
        $this->companyUseCase = $companyUseCase;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCompanyRequest $request)
    {
        $this->companyUseCase->createCompany($request->validated());

        return redirect()->route('companies.index');
    }
}
