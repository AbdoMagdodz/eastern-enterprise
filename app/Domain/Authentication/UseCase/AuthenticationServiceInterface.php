<?php

namespace App\Domain\Authentication\UseCase;

interface AuthenticationServiceInterface
{
    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function login(string $email, string $password): bool;

    /**
     * @return void
     */
    public function logout(): void;
}
