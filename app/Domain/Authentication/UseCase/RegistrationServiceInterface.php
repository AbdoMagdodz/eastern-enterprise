<?php

namespace App\Domain\Authentication\UseCase;

use App\Domain\User\Entity\User;

interface RegistrationServiceInterface
{
    /**
     * @param array $data
     * @return bool
     */
    public function register(array $data): bool;
}
