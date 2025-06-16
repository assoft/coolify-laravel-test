<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->company(),
            "region" => $this->faker->monthName(),
            "address" => $this->faker->address(),
            "phone" => $this->faker->phoneNumber(),
            "city" => $this->faker->city(),
            "state" => $this->faker->safeColorName(),
            "company_id" => \App\Models\Company::factory(),
        ];
    }
}
