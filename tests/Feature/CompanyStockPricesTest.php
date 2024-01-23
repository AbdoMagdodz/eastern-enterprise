<?php

namespace Feature;

use App\Domain\Company\Infrastructure\ExternalServices\AlphavantageStockService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;


class CompanyStockPricesTest extends TestCase
{
    use RefreshDatabase;

    private string $url;

    public function setUp(): void
    {
        parent::setUp();

        $this->url = env('ALPHAVANTAGE_API_URL');

    }

    /** @test */
    public function it_should_return_stock_details_correctly()
    {
        $res = [
            'Global Quote' => [
                '02. open' => '100.0000',
                '03. high' => '100.0000',
                '04. low' => '100.0000',
                '05. price' => '100.0000',
                '06. volume' => '100',
                '07. latest trading day' => '2021-01-01',
                '08. previous close' => '100.0000',
                '09. change' => '0.0000',
                '10. change percent' => '0.0000%',
            ]
        ];

        Http::fake([
            "$this->url*" => Http::response($res),
        ]);

        $stockService = new AlphavantageStockService;

        $this->assertSame($res['Global Quote'], $stockService->getStockData('MSFT'));
    }

    /** @test */
    public function it_should_return_information_in_case_limit_exceeded_correctly()
    {
        $res = [
            'Information' => 'Thank you for using Alpha Vantage! Our standard API call frequency is 25 calls per day.'];

        Http::fake([
            "$this->url*" => Http::response($res),
        ]);

        $stockService = new AlphavantageStockService;

        $this->assertSame($res, $stockService->getStockData('MSFT'));
    }

    /** @test */
    public function it_should_return_null_in_case_strange_response()
    {
        $res = ['123123' => []];

        Http::fake([
            "$this->url*" => Http::response($res),
        ]);

        $stockService = new AlphavantageStockService;

        $this->assertSame(null, $stockService->getStockData('MSFT'));
    }

}
