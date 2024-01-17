<?php

namespace App\Core\Infrastructure\Repositories;

use App\Core\Entities\Company as CompanyEntity;
use App\Core\Infrastructure\Repositories\CompanyRepositoryInterface;
use App\Models\Company;

class EloquentCompanyRepository implements CompanyRepositoryInterface
{
    /**
     * @param array $data
     * @return CompanyEntity
     */
    public function create(array $data): CompanyEntity
    {
        $company = Company::create($data);

        return new CompanyEntity(
            $company->id,
            $company->name,
            $company->symbol,
            $company->description,
            $company->address,
            $company->logo
        );
    }

    /**
     * @return CompanyEntity[]
     */
    public function getAll(): array
    {
        $eloquentCompanies = Company::orderBy('id', 'desc')->get();

        $companies = [];

        foreach ($eloquentCompanies as $eloquentCompany) {
            $companies[] = new CompanyEntity(
                $eloquentCompany->id,
                $eloquentCompany->name,
                $eloquentCompany->symbol,
                $eloquentCompany->description,
                $eloquentCompany->address,
                $eloquentCompany->logo
            );
        }

        return $companies;
    }
}
