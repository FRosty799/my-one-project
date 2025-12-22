<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::create([
            'name' => '4-Person Tent',
            'description' => 'Waterproof and spacious camping tent.',
            'price_per_day' => 15.00,
        ]);

        Item::create([
            'name' => 'Self-Inflating Mattress',
            'description' => 'Comfortable mattress for outdoor use.',
            'price_per_day' => 5.00,
        ]);

        Item::create([
            'name' => 'Climbing Rope (50m)',
            'description' => 'Professional grade dynamic climbing rope.',
            'price_per_day' => 12.00,
        ]);
    }
}