<?php

namespace App\Domain\Company\Entity\Repositories;

use App\Domain\Company\Entity\Company;

interface CompanyRepositoryInterface
{
    /**
     * @param array $data
     * @return Company
     */
    public function create(array $data): Company;

    /**
     * @return array
     */
    public function getAll(): array;
}
