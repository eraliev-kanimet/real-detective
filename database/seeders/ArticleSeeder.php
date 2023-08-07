<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        if (! Author::count()) {
            $author = $this->author();

            for ($i = 0; $i < 20; $i++) {
                $this->article($author);
            }
        }
    }

    protected function author(): Author
    {
        return Author::create([
            'name' => 'Першин Кирилл Олегович',
            'post' => 'Руководитель детективного агентства',
            'about' => 'Руководитель и лицо компании - Першин Кирилл Олегович – имеет большой эмпирический опыт в оказании детективных услуг, состоит в партнерских отношениях с ведущим медийным детективным агентством "Legion", является участником международных ассоциации детективов, ведет открытую и прозрачную политику работы, призывает не верить на слово своих заказчиков, а опираться только на подробные отчёты и факты. <br> Кирилл Олегович активно ведёт свой YouTube блог и социальные сети, где как специалист по безопасности даёт необходимые рекомендации, полезный материал и рассказывает о своих услугах и принципах их оказания.',
            'image' => fakeImage('articles')
        ]);
    }

    protected function article(Author $author): void
    {
        $name = fake()->unique()->sentence();

        $faq = [];

        for ($i = 0; $i < 5; $i++) {
            $faq[] = [
                'question' => fake()->sentence(),
                'answer' => fake()->paragraph,
            ];
        }

        Article::create([
            'author_id' => $author->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'read_time' => rand(3, 6),
            'tags' => ['tag'],
            'image' => fakeImage('articles'),
            'content' => $this->articleContent($author->id),
            'description' => fake()->paragraph,
            'faq' => $faq
        ]);
    }

    protected function articleContent(int $author_id): array
    {
        $icons = ['fire', 'car', 'cat'];

        return [
            $this->articleContentData('text', [
                'content' => fake()->paragraph . '. ' . fake()->paragraph
            ]),
            $this->articleContentData('text_with_headers_type_1', [
                'header' => fake()->sentence(),
                'items' => [
                    $this->articleContentData('text', [
                        'content' => fake()->paragraph . '. ' . fake()->paragraph
                    ]),
                    $this->articleContentData('subheader', [
                        'header' => fake()->sentence(),
                        'text' => fake()->paragraph . '. ' . fake()->paragraph,
                    ]),
                ]
            ]),
            $this->articleContentData('text_with_headers_type_2', [
                'header' => fake()->sentence(),
                'items' => array_map(function () use ($icons) {
                    return [
                        'icon' => $icons[rand(0, 2)],
                        'header' => fake()->sentence(),
                        'text' => fake()->paragraph . '. ' . fake()->paragraph,
                    ];
                }, [1, 2, 3])
            ]),
            $this->articleContentData('image', [
                'header' => fake()->sentence(),
                'text' => fake()->paragraph . '. ' . fake()->paragraph,
                'images' => [
                    ['image' => fakeImage('articles'), 'alt' => fake()->word],
                ]
            ]),
            $this->articleContentData('text_with_headers_type_3', [
                'header' => fake()->sentence(),
                'items' => array_map(function () {
                    return [
                        'header' => fake()->sentence(),
                        'text' => fake()->paragraph . '. ' . fake()->paragraph,
                    ];
                }, [1, 2, 3])
            ]),
            $this->articleContentData('image', [
                'header' => fake()->sentence(),
                'text' => fake()->paragraph . '. ' . fake()->paragraph,
                'images' => [
                    ['image' => fakeImage('articles'), 'alt' => fake()->word],
                    ['image' => fakeImage('articles')],
                ]
            ]),
            $this->articleContentData('quote', [
                'text' => fake()->paragraph . '. ' . fake()->paragraph,
                'author_id' => $author_id,
            ]),
            $this->articleContentData('quote2', [
                'text' => fake()->paragraph . '. ' . fake()->paragraph,
            ]),
            $this->articleContentData('image', [
                'images' => [
                    ['image' => fakeImage('articles'), 'alt' => fake()->word],
                    ['image' => fakeImage('articles'), 'alt' => fake()->word],
                    ['image' => fakeImage('articles'), 'alt' => fake()->word],
                ]
            ]),
        ];
    }

    protected function articleContentData(string $type, array $data): array
    {
        return [
            'type' => $type,
            'data' => $data
        ];
    }
}
