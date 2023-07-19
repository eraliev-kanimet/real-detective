<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    protected array $categories = [
        'Сбор информации' => [
            'Досье на человека',
            'Компромат на человека',
            'Организация слежки',
            'Пробить геолокацию по номеру телефона',
            'Проверка запрета на выезд',
        ],
        'Семейные вопросы' => [
            'Проверка образ жизни детей',
            'Проверить на верность',
            'Провокация измен',
            'Слежка за женой',
            'Слежка за мужем',
        ],
        'Расследования' => [
            'Журналистское расследование',
            'Расследование убийств',
            'Расследование мошенничества',
        ],
        'Розыск' => [
            'Поиск родственников',
            'Розыск имущества',
            'Поиск человека по адресу',
            'Розыск за границей',
            'Частный розыск',
        ],
        'Защита' => [
            'Поиск прослушки в квартире',
            'Обратиться в СМИ',
            'Выход из секты',
            'Помощь и защита при шантаже',
            'Защита от буллинга',
        ],
        'Журналистика' => [
            'Заказать расследование',
        ],
    ];

    public function run(): void
    {
        if (!Category::count()) {
            $this->generate('private_person');
            $this->generate('business');
        }
    }

    protected function generate(string $service): void
    {
        foreach ($this->categories as $name => $subcategories) {
            $category = Category::updateOrCreate([
                'name' => $name,
                'service' => $service,
            ], [
                'name' => $name,
                'service' => $service,
                'icon' => Str::slug(transliterate($name))
            ]);

            foreach ($subcategories as $subcategory) {
                $this->subcategory($category, $subcategory);
            }
        }
    }

    protected function subcategory(Category $category, string $name): void
    {
        $slug = Str::slug(transliterate(Category::$services[$category->service])) . '-';
        $slug .= $category->icon . '-' . Str::slug(transliterate($name));

        $content = [];
        $faq = [];

        for ($i = 0; $i < 5; $i++) {
            $content[] = [
                'header' => fake()->sentence(),
                'content' => fake()->paragraph
            ];
            $faq[] = [
                'question' => fake()->sentence(),
                'answer' => fake()->paragraph
            ];
        }

        Subcategory::updateOrCreate([
            'category_id' => $category->id,
            'slug' => $slug
        ], [
            'category_id' => $category->id,
            'slug' => $slug,
            'name' => $name,
            'basic' => [
                'h1' => $name,
                'description' => fake()->paragraph,
                'rating' => 5,
                'video' => 'https://www.youtube.com/watch?v=6DYQkCiiLIM',
            ],
            'contract_type' => 'Депозитный',
            'average_receipt' => 50000,
            'minimum_advance_amount' => 50000,
            'content' => $content,
            'faq' => $faq,
        ]);
    }
}
