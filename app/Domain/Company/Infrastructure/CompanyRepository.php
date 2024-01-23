<?php

namespace App\Domain\Company\Infrastructure;

use App\Domain\Company\Entity\Company as CompanyEntity;
use App\Domain\Company\Entity\Repositories\CompanyRepositoryInterface;
use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface
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
            $company->street,
            $company->postal_code,
            $company->country,
            $company->phone_number,
            $company->logo
        );
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $eloquentCompanies = Company::orderBy('id', 'desc')->get();

        $companies = [];

        foreach ($eloquentCompanies as $eloquentCompany) {
            $companies[] = new CompanyEntity(
                id: $eloquentCompany->id,
                name: $eloquentCompany->name,
                symbol: $eloquentCompany->symbol,
                description: $eloquentCompany->description,
                street: $eloquentCompany->street,
                postalCode: $eloquentCompany->postal_code,
                country: $eloquentCompany->country,
                phoneNumber: $eloquentCompany->phone_number,
                logo: $eloquentCompany->logo
            );
        }

        return $companies;
    }
}
