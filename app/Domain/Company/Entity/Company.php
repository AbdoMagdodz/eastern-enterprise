<?php

namespace App\Domain\Company\Entity;

class Company
{
    /**
     * @param int|null $id
     * @param string $name
     * @param string $symbol
     * @param string $description
     * @param string $street
     * @param string $postalCode
     * @param string $country
     * @param string $phoneNumber
     * @param string $logo
     */
    public function __construct(
        public int|null $id,
        public string $name,
        public string $symbol,
        public string $description,
        public string $street,
        public string $postalCode,
        public string $country,
        public string $phoneNumber,
        public string $logo
    ) {
    }
}
