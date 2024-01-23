<?php

namespace App\Domain\Company\UseCase;

use App\Domain\Company\Entity\Company;
use App\Domain\Company\Entity\Repositories\CompanyRepositoryInterface;
use App\Domain\Company\Infrastructure\ExternalServices\AlphavantageStockService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyUseCase
{
    /**
     * @param CompanyRepositoryInterface $companyRepository
     * @param AlphavantageStockService $stockService
     */
    public function __construct(private readonly CompanyRepositoryInterface $companyRepository, private readonly AlphavantageStockService $stockService)
    {

    }

    /**
     * @param array $data
     * @return Company
     */
    public function createCompany(array $data): Company
    {
        // Handle file upload
        $logoFileName = $this->uploadLogo($data['logo']);
        $data['logo'] = $logoFileName;

        return $this->companyRepository->create($data);
    }


    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->companyRepository->getAll();
    }


    /**
     * @param $file
     * @return string
     */
    private function uploadLogo($file): string
    {
        $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs('public/logos', $file, $fileName);

        return $fileName;
    }


    /**
     * @param string $companySymbol
     * @return array|null
     */
    public function getCompanyStockData(string $companySymbol): array|null
    {
        return $this->stockService->getStockData($companySymbol);
    }
}
