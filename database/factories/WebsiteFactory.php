<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'active' => 1,
            'url' => $this->faker->url(),
            'type' => $this->faker->randomElement(['news', 'sport', 'tech']),
        ];
    }
}
