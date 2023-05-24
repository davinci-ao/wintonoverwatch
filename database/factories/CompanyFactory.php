<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
            'short_description' => $this->faker->name(),
            'long_description' => $this->faker->text($maxNbChars = 800),
            'contact' => $this->faker->name(),
            'mail' => $this->faker->name(),
            'website_link' => $this->faker->name(),
            'location' => $this->faker->name(),
            'phone_number' => $this->faker->boolean,
        ];
    }
}
