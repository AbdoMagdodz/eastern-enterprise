<?php

namespace App\Core\Infrastructure\Repositories;

use App\Core\Entities\Company;

interface CompanyRepositoryInterface
{
    public function create(array $data): Company;
    public function getAll(): array;
}
