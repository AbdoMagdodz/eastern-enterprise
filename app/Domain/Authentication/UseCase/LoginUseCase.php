<?php

namespace App\Domain\Authentication\UseCase;

use Illuminate\Support\Facades\Auth;

class LoginUseCase implements AuthenticationServiceInterface
{
    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function login(string $email, string $password): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
    }
}
