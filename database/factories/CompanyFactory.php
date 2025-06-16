<?php

namespace Database\Factories;

use App\Models\User;
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
            "user_id" => User::factory()->business()->create()->id,
            "name" => $this->faker->company(),
            "tax_id" => $this->faker->unique()->randomNumber(),
            "address" => $this->faker->unique()->address(),
            "phone" => $this->faker->unique()->phoneNumber(),
        ];
    }
}
