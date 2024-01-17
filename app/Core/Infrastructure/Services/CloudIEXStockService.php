<?php

namespace App\Core\Infrastructure\Services;

use App\Core\Infrastructure\Services\StockServiceInterface;
use Illuminate\Support\Facades\Http;

class CloudIEXStockService implements StockServiceInterface
{
    /**
     * @param string $symbol
     * @return array|null
     */
    public function getStockData(string $symbol)
    {
        $apiKey = env('CLOUD_IEX_API_TOKEN');

        $response = Http::get("https://cloud.iexapis.com/stable/stock/$symbol/quote", [
            'token' => $apiKey,
        ]);

        return $response->json() ?? null;
    }
}
