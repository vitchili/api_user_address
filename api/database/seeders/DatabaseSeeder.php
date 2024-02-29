<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $states = ["Alaska", "Alabama", "Arkansas", "American Samoa", "Arizona", "California", "Colorado", "Connecticut", "District of Columbia", "Delaware", "Florida", "Georgia", "Guam", "Hawaii", "Iowa", "Idaho", "Illinois", "Indiana", "Kansas", "Kentucky", "Louisiana", "Massachusetts", "Maryland", "Maine", "Michigan", "Minnesota", "Missouri", "Mississippi", "Montana", "North Carolina", "North Dakota", "Nebraska", "New Hampshire", "New Jersey", "New Mexico", "Nevada", "New York", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Puerto Rico", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Virginia", "Virgin Islands", "Vermont", "Washington", "Wisconsin", "West Virginia", "Wyoming"];

        for ($i = 1; $i <= 10; $i++) {
            \App\Models\User::create([
                'name' => fake()->name(),
                'age' => fake()->numberBetween(1, 99),
                'email' => fake()->unique()->safeEmail(),
            ]);

            \App\Models\State::create([
                'name' => $states[$i],
            ]);

            \App\Models\City::create([
                'name' => fake()->unique()->city(),
                'state_id' => fake()->randomDigitNotZero(),
            ]);

            \App\Models\Address::create([
                'user_id'  => $i,
                'street'   => fake()->unique()->streetName(),
                'number'   => fake()->unique()->numberBetween(1, 1000),
                'zip_code' => fake()->unique()->postcode(),
                'city_id'  => fake()->randomDigitNotZero(),
            ]);
        }
    }
}
