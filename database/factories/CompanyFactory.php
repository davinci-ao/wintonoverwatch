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
            'name' => $this->faker->company(),
            'short_description' => $this->faker->name(),
            'internship' => $this->faker->name(),
            'languages' => $this->faker->name(),
            'long_description' => $this->faker->text($maxNbChars = 800),
            'contact' => $this->faker->name(),
            'mail' => $this->faker->name(),
            'website_link' => $this->faker->name(),
            'location' => $this->faker->address(),
            'phone_number' => $this->faker->boolean,
            'image' => 'https://cdn.pixabay.com/photo/2015/10/30/20/13/sunrise-1014712_1280.jpg', 
        ];
    }
}
