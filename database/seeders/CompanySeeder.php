<?php

namespace Database\Seeders;

use App\Models\Company;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wellKnownCompanies = [
            'AAPL' => [
                "name" => "Apple Inc.",
                "logo" => "apple.png"
            ],
            'MSFT' => [
                "name" => "Microsoft Corporation",
                "logo" => "microsoft.png"
            ],
            'AMZN' => [
                "name" => "Amazon.com, Inc.",
                "logo" => "amazon.png"
            ],
            'GOOGL' => [
                "name" => "Alphabet Inc",
                "logo" => "google.png"
            ],
        ];

        $faker = Faker::create();
        $companies = [];

        foreach ($wellKnownCompanies as $symbol => $details) {
            $companies[] = [
                'name' => $details['name'],
                'logo' => $details['logo'],
                'symbol' => $symbol,
                'description' => $faker->text,
                'address' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Company::insert($companies);
    }
}
