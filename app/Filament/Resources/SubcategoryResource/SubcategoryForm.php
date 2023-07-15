<?php

namespace App\Filament\Resources\SubcategoryResource;

use App\Helpers\FilamentHelper;
use App\Models\Category;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubcategoryForm
{
    public static function form(): array
    {
        $helper = new FilamentHelper;

        return [
            $helper->grid([
                $helper->textInput('name')
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $set('slug', Str::slug(transliterate($state)));
                    }),
                $helper->textInput('slug')
                    ->disabled()
                    ->unique(ignorable: fn(null|Model $record): null|Model => $record),
            ]),
            $helper->textInput('basic.h1'),
            $helper->textarea('basic.description'),
            $helper->grid([
                $helper->select('category_id', Category::all()->pluck('name', 'id')),
                $helper->select('contract_type', ['Deposit' => 'Deposit']),
                $helper->numericInputWithMinMaxValue('basic.rating', 0, 5),
                $helper->textInput('basic.video'),
                $helper->numericInputWithMinValue('average_receipt'),
                $helper->numericInputWithMinValue('minimum_advance_amount'),
            ]),
            $helper->toggle('visible', true),
            $helper->repeater('content', [
                $helper->textInput('header'),
                $helper->richEditor('content'),
            ])->required(),
            $helper->repeater('faq', [
                $helper->textInput('question'),
                $helper->textarea('content'),
            ])->required(),
        ];
    }
}


