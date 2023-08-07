<?php

namespace App\Filament\Resources\ArticleResource;

use App\Models\Author;
use Closure;
use App\Helpers\FilamentHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ArticleResourceForm
{
    public static function form(): array
    {
        $helper = new FilamentHelper;
        $authors = Author::all()->pluck('name', 'id');

        return [
            $helper->tabs([
                $helper->tab('Basic', [
                    $helper->grid([
                        $helper->textInput('name')
                            ->label('Название')
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state) {
                                $set('slug', Str::slug(transliterate($state)));
                            }),
                        $helper->textInput('slug')
                            ->disabled()
                            ->unique(ignorable: fn(null|Model $record): null|Model => $record),
                        $helper->textarea('description')->label('Описание')->rows(7),
                        $helper->image('image')
                            ->label('Картинка')
                            ->imageResizeTargetWidth('900px')
                            ->imageResizeTargetHeight('507px')
                            ->imageResizeMode('force'),
                        $helper->select('author_id', $authors)
                            ->label('Автор'),
                        $helper->numericInputWithMinValue('read_time')->label('Время чтение'),
                    ]),
                    $helper->tags('tags')->label('Теги'),
                ]),
                $helper->tab('Контент', [
                    $helper->builder('content', [
                        $helper->builderBlock('text', [
                            $helper->textarea('content')->label(''),
                        ])->icon('heroicon-o-menu')->label('Текст'),
                        $helper->builderBlock('text_with_headers_type_1', [
                            $helper->textInput('header')->label('Заголовок'),
                            $helper->builder('items', [
                                $helper->builderBlock('text', [
                                    $helper->textarea('content')->label(''),
                                ])->label('Текст'),
                                $helper->builderBlock('subheader', [
                                    $helper->textInput('header')->label('Под-заголовок'),
                                    $helper->textarea('text')->label('Текст'),
                                ])->label('Текст с под-заголовком'),
                            ])
                        ])->icon('heroicon-o-document-text')->label('Текст с заголовком 1'),
                        $helper->builderBlock('text_with_headers_type_2', [
                            $helper->textInput('header')->label('Заголовок'),
                            $helper->repeater('items', [
                                $helper->select('icon', [
                                    'fire' => 'Пламя',
                                    'car' => 'Автомобиль',
                                    'cat' => 'Кот',
                                ])->label('Иконка'),
                                $helper->textInput('header')->label('Под-заголовок'),
                                $helper->textarea('text')->label('Текст'),
                            ])->createItemButtonLabel('Добавить под-заголовок с текстом'),
                        ])->icon('heroicon-o-newspaper')->label('Текст с заголовком 2'),
                        $helper->builderBlock('text_with_headers_type_3', [
                            $helper->textInput('header')->label('Заголовок'),
                            $helper->repeater('items', [
                                $helper->textInput('header')->label('Под-заголовок'),
                                $helper->textarea('text')->label('Текст'),
                            ])->createItemButtonLabel('Добавить под-заголовок с текстом'),
                        ])->icon('heroicon-o-document-text')->label('Текст с заголовком 3'),
                        $helper->builderBlock('image', [
                            $helper->textInputNullable('header')->label('Заголовок'),
                            $helper->textareaNullable('text')->label('Описание'),
                            $helper->repeater('images', [
                                $helper->image('image')
                                    ->label('Картинка')
                                    ->imageResizeTargetWidth('900px')
                                    ->imageResizeTargetHeight('507px')
                                    ->imageResizeMode('force'),
                                $helper->textInputNullable('alt'),
                            ])->label('Картинки')
                        ])->icon('heroicon-o-photograph')->label('Картинки'),
                        $helper->builderBlock('quote', [
                            $helper->textarea('text')->label('Текст'),
                            $helper->select('author_id', $authors)->label('Автор')
                        ])->icon('heroicon-o-information-circle')->label('Цитата'),
                        $helper->builderBlock('quote2', [
                            $helper->textarea('text')->label('Текст'),
                        ])->icon('heroicon-o-information-circle')->label('Цитата (Без автора)'),
                        $helper->builderBlock('info', [
                            $helper->textarea('text')->label('Текст'),
                        ])->icon('heroicon-o-information-circle')->label('Инфо'),
                    ])->required(),
                ]),
                $helper->tab('FAQ', [
                    $helper->repeater('faq', [
                        $helper->textInput('question')->label('Вопрос'),
                        $helper->textarea('answer')->label('Ответ'),
                    ])->required()->label(''),
                ]),
            ])
        ];
    }
}
