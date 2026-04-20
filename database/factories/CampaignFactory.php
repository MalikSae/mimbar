<?php

namespace Database\Factories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $baseNames = [
            'Wakaf Pembebasan Lahan',
            'Sedekah Air Bersih',
            'Bantuan Santri Penghafal Quran',
            'Tebar Qurban Nusantara',
            'Beasiswa Santri Yatim',
            'Pembangunan Masjid Pelosok'
        ];
        
        $name = $this->faker->randomElement($baseNames) . ' ' . $this->faker->city();

        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(100, 9999),
            'utm_source' => $this->faker->randomElement(['facebook', 'instagram', 'whatsapp', 'website']),
            'utm_medium' => $this->faker->randomElement(['social', 'cpc', 'organic']),
            'utm_campaign' => Str::slug($name),
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+3 months'),
            'status' => $this->faker->randomElement(['draft', 'active', 'ended']),
        ];
    }
}
