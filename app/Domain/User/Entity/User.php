<?php

namespace App\Domain\User\Entity;

use Illuminate\Auth\Authenticatable;

class User
{
    use Authenticatable;

    /**
     * @param int|null $id
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(
        public int|null $id,
        public string   $name,
        public string   $email,
        public string   $password
    )
    {
    }


}

