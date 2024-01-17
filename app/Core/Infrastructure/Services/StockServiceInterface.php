<?php

namespace App\Core\Infrastructure\Services;

interface StockServiceInterface
{
    public function getStockData(string $symbol);
}