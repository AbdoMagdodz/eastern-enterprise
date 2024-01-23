<?php

namespace App\Domain\Authentication\UseCase;

use App\Domain\User\Entity\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class RegisterUseCase implements RegistrationServiceInterface
{
    /**
     * @param UserRepositoryInterface $userRepository
     * @param LoginUseCase $loginUseCase
     */
    public function __construct(private readonly UserRepositoryInterface $userRepository, private readonly LoginUseCase $loginUseCase)
    {
    }

    /**
     * @param array $data
     * @return bool
     */
    public function register(array $data): bool
    {
        $user = $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return $this->loginUseCase->login($user->email, $data['password']);
    }
}
