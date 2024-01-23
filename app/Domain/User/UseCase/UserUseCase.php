<?php

namespace App\Domain\User\UseCase;

use App\Domain\User\Entity\User;
use App\Domain\User\Entity\Repositories\UserRepositoryInterface;

class UserUseCase
{
    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {

    }

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        return $this->userRepository->create($data);
    }
}
