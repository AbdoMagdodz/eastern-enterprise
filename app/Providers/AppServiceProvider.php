<?php

namespace App\Providers;

use App\Domain\Company\Entity\Repositories\CompanyRepositoryInterface;
use App\Domain\Company\Infrastructure\CompanyRepository;
use App\Domain\User\Entity\Repositories\UserRepositoryInterface;
use App\Domain\User\Infrastructure\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
