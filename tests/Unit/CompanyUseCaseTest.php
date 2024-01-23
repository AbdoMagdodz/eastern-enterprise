<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\MockObject\MockObject;
use App\Domain\Company\UseCase\CompanyUseCase;
use App\Domain\Company\Entity\Repositories\CompanyRepositoryInterface;
use App\Domain\Company\Infrastructure\ExternalServices\AlphavantageStockService;
use Tests\TestCase;
use App\Domain\Company\Entity\Company;

class CompanyUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private CompanyUseCase $companyUseCase;
    private CompanyRepositoryInterface $companyRepository;
    private AlphavantageStockService $stockService;

    public function setUp(): void
    {
        parent::setUp();

        $this->companyRepository = app(CompanyRepositoryInterface::class);
        $this->stockService = $this->createMock(AlphavantageStockService::class);
        $this->companyUseCase = new CompanyUseCase($this->companyRepository, $this->stockService);
    }

    /** @test */
    public function it_should_create_a_company_successfully()
    {
        $companyData = [
            'name' => 'Example Company',
            'symbol' => 'META',
            'logo' => UploadedFile::fake()->create('document.png', 1024),
            'street' => '123 Example St',
            'country' => 'Country',
            'postal_code' => '12345',
            'phone_number' => '1234567890',
            'description' => 'This is an example company.',
            'address' => '123 Example St, City',
        ];

        $company = $this->companyUseCase->createCompany($companyData);

        $this->assertInstanceOf(Company::class, $company);
        $this->assertDatabaseHas('companies', [
            'name' => 'Example Company',
            'description' => 'This is an example company.',
        ]);

        // Clean up uploaded files after the test
        Storage::disk('public')->delete('logos/' . $company->logo);
    }

    /** @test */
    public function it_should_return_all_companies_successfully()
    {
        $file = UploadedFile::fake()->create('logo.png', 1024);
        $company = [
            'logo' => $file,
            'street' => '123 Example St',
            'country' => 'Country',
            'postal_code' => '12345',
            'phone_number' => '1234567890',
            'description' => 'This is an example company c1.',
            'address' => '123 Example St, City',
        ];

        $companyData = [
            [
                ...$company,
                'name' => 'c1',
                'symbol' => 'META',
            ],
            [
                ...$company,
                'name' => 'c2',
                'symbol' => 'APPL',
            ]
        ];

        $company1 = $this->companyUseCase->createCompany($companyData[0]);
        $company2 = $this->companyUseCase->createCompany($companyData[1]);

        $returnedCompanies = $this->companyUseCase->getAll();

        $this->assertCount(2, $returnedCompanies);
        $this->assertInstanceOf(Company::class, $returnedCompanies[0]);
        $this->assertInstanceOf(Company::class, $returnedCompanies[1]);
        $this->assertSame($company2->name, $returnedCompanies[0]->name);
        $this->assertSame($company1->name, $returnedCompanies[1]->name);
        Storage::disk('public')->delete('logos/' . $company1->logo);
        Storage::disk('public')->delete('logos/' . $company2->logo);
    }

    /** @test */
    public function it_can_get_company_stock_data()
    {
        $companyUseCase = new CompanyUseCase($this->companyRepository, $this->stockService);
        $companySymbol = 'AAPL';
        $expectedStockData = ['symbol' => 'AAPL', 'price' => 150.0];

        $this->stockService
            ->expects($this->once())
            ->method('getStockData')
            ->with($companySymbol)
            ->willReturn($expectedStockData);

        $result = $companyUseCase->getCompanyStockData($companySymbol);

        $this->assertSame($expectedStockData, $result);
    }

}
