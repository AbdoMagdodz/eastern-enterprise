<?php

use App\Core\Entities\Company;
use App\Core\Infrastructure\Repositories\CompanyRepositoryInterface;
use App\Core\Infrastructure\Services\CloudIEXStockService;
use App\Core\Infrastructure\Services\StockServiceInterface;
use App\Core\UseCases\Company\CompanyUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class CompanyUseCaseTest extends TestCase
{
    use RefreshDatabase;

    private CompanyUseCase $companyUseCase;
    private CompanyRepositoryInterface $companyRepository;
    private StockServiceInterface $stockServiceRepository;
    private StockServiceInterface|MockObject $cloudStockService;

    public function setUp(): void
    {
        parent::setUp();

        $this->companyRepository = app(CompanyRepositoryInterface::class);
        $this->stockServiceRepository = app(StockServiceInterface::class);
        $this->companyUseCase = new CompanyUseCase($this->companyRepository, $this->stockServiceRepository);

        // Create a mock instance of StockService
        $this->cloudStockService = $this->createMock(CloudIEXStockService::class);
    }

    /** @test */
    public function it_should_create_a_company_successfully()
    {
        $companyData = [
            'name' => 'Example Company',
            'symbol' => 'META',
            'logo' => ,
            'description' => 'This is an example company.',
            'address' => '123 Example St, City',
        ];

        $company = $this->companyUseCase->createCompany($companyData);

        $this->assertInstanceOf(Company::class, $company);
        $this->assertDatabaseHas('companies', [
            'name' => 'Example Company',
            'description' => 'This is an example company.',
        ]);
    }

    /** @test */
    public function it_should_return_all_companies_successfully()
    {
        $file = UploadedFile::fake()->create('document.pdf', 1024);

        $companyData = [
            [
                'name' => 'c1',
                'symbol' => 'META',
                'logo' => $file,
                'description' => 'This is an example company c1.',
                'address' => '123 Example St, City',
            ],
            [
                'name' => 'c2',
                'symbol' => 'APPL',
                'logo' => $file,
                'description' => 'This is an example company c2.',
                'address' => '123 Example St, City',
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
    }

    /** @test */
    public function it_can_get_company_stock_data()
    {
        $companyUseCase = new CompanyUseCase($this->companyRepository, $this->cloudStockService);
        $companySymbol = 'AAPL';
        $expectedStockData = ['symbol' => 'AAPL', 'price' => 150.0];

        $this->cloudStockService
            ->expects($this->once())
            ->method('getStockData')
            ->with($companySymbol)
            ->willReturn($expectedStockData);

        $result = $companyUseCase->getCompanyStockData($companySymbol);

        $this->assertSame($expectedStockData, $result);
    }
}
