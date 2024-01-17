<?php

namespace App\Core\UseCases\Company;

use App\Core\Entities\Company;
use App\Core\Infrastructure\Services\StockServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Core\Infrastructure\Repositories\CompanyRepositoryInterface;

class CompanyUseCase
{
    /**
     * @param CompanyRepositoryInterface
     * @param StockServiceInterface
     */
    public function __construct(private CompanyRepositoryInterface $companyRepository, private StockServiceInterface $stockService)
    {
        $this->companyRepository = $companyRepository;
        $this->stockService = $stockService;
    }

    /**
     * @param array $data
     * 
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
     * @return Company[]
     */
    public function getAll(): array
    {
        return $this->companyRepository->getAll();
    }

    /**
     * @param $file
     * 
     * @return string
     */
    private function uploadLogo($file)
    {
        $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs('public/logos', $file, $fileName);

        return $fileName;
    }

    /**
     * @param string $companySymbol
     * 
     * @return array
     */
    public function getCompanyStockData(string $companySymbol)
    {
        $stockData = $this->stockService->getStockData($companySymbol);

        return $stockData;
    }
}
