<?php

namespace App\Domain\User\Entity\Repositories;

use App\Domain\User\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User;
}
