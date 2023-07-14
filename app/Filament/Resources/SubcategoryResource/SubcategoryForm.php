<?php

namespace App\Filament\Resources\SubcategoryResource;

use App\Helpers\FilamentHelper;
use App\Models\Category;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubcategoryForm
{
    public function __construct(
        protected FilamentHelper $helper
    )
    {
    }

    public static function form(): array
    {
        $self = new SubcategoryForm(new FilamentHelper);

        return [
            $self->helper->select('category_id', Category::all()->pluck('name', 'id')),
            $self->helper->textInput('name')
                ->reactive()
                ->afterStateUpdated(function (Closure $set, $state) {
                    $set('slug', Str::slug(transliterate($state)));
                }),
            $self->helper->textInput('slug')
                ->disabled()
                ->unique(ignorable: fn(null|Model $record): null|Model => $record),
            $self->helper->textInput('basic.h1'),
            $self->helper->textarea('basic.description'),
            $self->helper->numericInputWithMinMaxValue('basic.rating', 0, 5),
            $self->helper->textInput('basic.video'),
            $self->helper->toggle('visible', true),
            $self->helper->select('contract_type', ['Deposit' => 'Deposit']),
            $self->helper->numericInputWithMinValue('average_receipt', 0),
            $self->helper->numericInputWithMinValue('minimum_advance_amount', 0),
            $self->helper->repeater('content', [
                $self->helper->textInput('header'),
                $self->helper->richEditor('content'),
            ])->required(),
            $self->helper->repeater('faq', [
                $self->helper->textInput('question'),
                $self->helper->textarea('content'),
            ])->required(),
        ];
    }
}


