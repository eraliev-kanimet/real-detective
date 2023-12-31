<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            Review::create([
                'name' => fake()->unique()->name,
                'content' => fake()->paragraph,
                'rating' => number_format(4 + (5 - 4) * (mt_rand() / mt_getrandmax()), 1),
                'url' => 'https://yandex.ru/maps/org/pershin_partners/77630423623/reviews/?add-review=true'
            ]);
        }
    }
}
