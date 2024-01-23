<?php

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Entity\User as UserEntity;
use App\Domain\User\Entity\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param array $data
     * @return UserEntity
     */
    public function create(array $data): UserEntity
    {
        $user = User::create($data);

        return new UserEntity(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            password: $data['password'],
        );
    }
}
