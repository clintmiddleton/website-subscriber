<?php

namespace Database\Factories;

use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'title' => $this->faker->paragraph(1, false),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->text(),
        ];
    }
}
