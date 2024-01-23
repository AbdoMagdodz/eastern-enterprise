<?php

namespace App\Domain\Company\Infrastructure\ExternalServices;

use Illuminate\Support\Facades\Http;

class AlphavantageStockService
{
    /**
     * @param string $symbol
     * @return array|null
     */
    public function getStockData(string $symbol): array|null
    {
        $apiKey = env('ALPHAVANTAGE_API_TOKEN');

        $response = Http::get("https://www.alphavantage.co/query", [
            'function' => 'GLOBAL_QUOTE',
            'symbol' => $symbol,
            'apikey' => $apiKey,
        ]);

        $json = $response->json();

        if (isset($json['Information'])) {
            return $json;
        }

        return $json['Global Quote'] ?? null;
    }
}
