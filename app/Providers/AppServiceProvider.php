<?php

namespace App\Providers;

use App\Core\Infrastructure\Services\StockServiceInterface;
use App\Core\Infrastructure\Repositories\EloquentCompanyRepository;
use App\Core\Infrastructure\Repositories\CompanyRepositoryInterface;
use App\Core\Infrastructure\Services\CloudIEXStockService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CompanyRepositoryInterface::class, EloquentCompanyRepository::class);
        $this->app->bind(StockServiceInterface::class, CloudIEXStockService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
