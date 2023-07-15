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
                            ->reactive()
                            ->afterStateUpdated(function (Closure $set, $state) {
                                $set('slug', Str::slug(transliterate($state)));
                            }),
                        $helper->textInput('slug')
                            ->disabled()
                            ->unique(ignorable: fn(null|Model $record): null|Model => $record),
                        $helper->textarea('description')->rows(7),
                        $helper->image('image'),
                        $helper->select('author_id', $authors)
                            ->label('Author'),
                        $helper->numericInputWithMinValue('read_time'),
                    ]),
                    $helper->tags('tags'),
                ]),
                $helper->tab('Content', [
                    $helper->builder('content', [
                        $helper->builderBlock('text', [
                            $helper->richEditor('content')->label(''),
                        ]),
                        $helper->builderBlock('text_with_headers_type_1', [
                            $helper->textInput('header'),
                            $helper->builder('items', [
                                $helper->builderBlock('text', [
                                    $helper->richEditor('content')->label(''),
                                ]),
                                $helper->builderBlock('subheader', [
                                    $helper->textInput('header'),
                                    $helper->richEditor('text'),
                                ]),
                            ])
                        ]),
                        $helper->builderBlock('text_with_headers_type_2', [
                            $helper->textInput('header'),
                            $helper->builder('items', [
                                $helper->builderBlock('text', [
                                    $helper->richEditor('content')->label(''),
                                ]),
                                $helper->builderBlock('subheader', [
                                    $helper->select('icon', [
                                        'icon1' => 'Icon 1',
                                        'icon2' => 'Icon 2',
                                        'icon3' => 'Icon 3',
                                    ]),
                                    $helper->textInput('header'),
                                    $helper->richEditor('text'),
                                ]),
                            ])
                        ]),
                        $helper->builderBlock('text_with_headers_type_3', [
                            $helper->textInput('header'),
                            $helper->builder('items', [
                                $helper->builderBlock('text', [
                                    $helper->richEditor('content')->label(''),
                                ]),
                                $helper->builderBlock('subheader', [
                                    $helper->textInput('header'),
                                    $helper->richEditor('text'),
                                ]),
                            ])
                        ]),
                        $helper->builderBlock('image', [
                            $helper->textInputNullable('header'),
                            $helper->textareaNullable('text'),
                            $helper->repeater('images', [
                                $helper->image('image'),
                                $helper->textInputNullable('alt'),
                            ])
                        ]),
                        $helper->builderBlock('quote', [
                            $helper->richEditor('text'),
                            $helper->select('author_id', $authors)->label('Author')
                        ]),
                    ])->required(),
                ]),
                $helper->tab('FAQ', [
                    $helper->repeater('faq', [
                        $helper->textInput('question'),
                        $helper->richEditor('answer'),
                    ])->required(),
                ]),
            ])
        ];
    }
}
