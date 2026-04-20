<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\LandingPage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<LandingPage>
 */
class LandingPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(4);
        
        return [
            'campaign_id' => Campaign::factory(),
            'title' => ucwords($title),
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'canvas_mode' => $this->faker->randomElement(['full_canvas', 'full_page']),
            'meta_title' => $title,
            'meta_description' => $this->faker->paragraph(),
            'og_image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'published_at' => $this->faker->optional(0.8)->dateTimeThisYear(),
        ];
    }
}
