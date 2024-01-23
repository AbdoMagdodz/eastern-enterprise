<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'symbol' => $this->faker->word(),
            'description' => $this->faker->text(),
            'street' => $this->faker->streetName(),
            'country' => $this->faker->country(),
            'postal_code' => $this->faker->postcode(),
            'phone_number' => $this->faker->phoneNumber(),
            'logo' => $this->faker->imageUrl(),
        ];
    }
}
