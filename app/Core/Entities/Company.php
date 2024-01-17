<?php

namespace App\Core\Entities;

class Company
{
    /**
     * @_constructor
     * @param int|null $id
     * @param string $name
     * @param string $symbol
     * @param string $description
     * @param string $address
     * @param string $logo
     * 
     * @return void
     */
    public function __construct(
        public int|null $id,
        public string $name,
        public string $symbol,
        public string $description,
        public string $address,
        public string $logo
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->symbol = $symbol;
        $this->description = $description;
        $this->address = $address;
        $this->logo = $logo;
    }
}
