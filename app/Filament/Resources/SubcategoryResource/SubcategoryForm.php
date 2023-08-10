<?php

namespace App\Filament\Resources\SubcategoryResource;

use App\Helpers\FilamentHelper;
use App\Models\Category;
use App\Models\Subcategory;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubcategoryForm
{
    public static function form(): array
    {
        $helper = new FilamentHelper;

        return [
            $helper->tabs([
                $helper->tab('Основная', [
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
                    ]),
                    $helper->textarea('basic.description')->label('Описание'),
                    $helper->grid([
                        $helper->select('category_id', Category::all()->pluck('name', 'id'))
                            ->label('Категория'),
                        $helper->select('contract_type', ['Депозитный' => 'Депозитный'])->label('Тип контракта'),
                    ]),
                    $helper->select('basic.related', Subcategory::pluck('name', 'id'))
                        ->label('Похожее услуги')
                        ->multiple(),
                    $helper->grid([
                        $helper->numericInputWithMinMaxValue('basic.rating', 0, 5)
                            ->label('Оценка'),
                        $helper->numericInputWithMinValue('average_receipt')->label('Средний чек'),
                        $helper->numericInputWithMinValue('minimum_advance_amount')
                            ->label('Размер минимального аванса'),
                    ], 3),
                    $helper->fieldset('Видео', [
                        $helper->textInput('basic.video.url')->label('Ссылка на видео'),
                        $helper->image('basic.video.image')
                            ->label('Видео обложка')
                            ->imageResizeTargetHeight('314px')
                            ->imageResizeTargetWidth('560px')
                            ->imageResizeMode('force'),
                    ]),
                    $helper->toggle('visible', true)->label('Активный'),
                ]),
                $helper->tab('Контент', [
                    $helper->repeater('content', [
                        $helper->textInput('header')->label('Заголовок'),
                        $helper->richEditor('content')->label('Описание'),
                    ])->required()->label('')
                ]),
                $helper->tab('FAQ', [
                    $helper->repeater('faq', [
                        $helper->textInput('question')->label('Вопрос'),
                        $helper->textarea('answer')->label('Ответ'),
                    ])->required()->label(''),
                ]),
                $helper->tab('SEO', [
                    $helper->textInput('basic.seo.name')
                        ->label('Название')
                        ->reactive(),
                    $helper->textarea('basic.seo.description')->label('Описание'),
                ]),
            ]),
        ];
    }
}


