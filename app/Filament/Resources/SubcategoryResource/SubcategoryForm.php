<?php

namespace App\Filament\Resources\SubcategoryResource;

use App\Models\Category;
use Closure;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubcategoryForm
{
    public function form(): array
    {
        return [
            ...$this->basic(),
            $this->content(),
            $this->faq(),
        ];
    }

    protected function basic(): array
    {
        return [
            Select::make('category_id')
                ->options(Category::all()->pluck('name', 'id'))
                ->required(),
            TextInput::make('name')
                ->required()
                ->reactive()
                ->afterStateUpdated(function (Closure $set, $state) {
                    $set('slug', Str::slug(transliterate($state)));
                }),
            TextInput::make('slug')
                ->required()
                ->disabled()
                ->unique(ignorable: fn(null|Model $record): null|Model => $record),
            TextInput::make('basic.h1')
                ->required(),
            Textarea::make('basic.description')
                ->required(),
            TextInput::make('basic.rating')
                ->numeric()
                ->minValue(0)
                ->maxValue(5)
                ->required(),
            TextInput::make('basic.video')
                ->required(),
            Toggle::make('visible')
                ->default(true)
                ->required(),
            Select::make('contract_type')
                ->options(['Deposit' => 'Deposit'])
                ->required(),
            TextInput::make('average_receipt')
                ->numeric()
                ->minValue(0)
                ->required(),
            TextInput::make('minimum_advance_amount')
                ->numeric()
                ->minValue(0)
                ->required(),
        ];
    }

    protected function content()
    {
        return Repeater::make('content')
            ->schema([
                TextInput::make('header')
                    ->required(),
                RichEditor::make('content')
                    ->disableToolbarButtons([
                        'attachFiles',
                        'codeBlock',
                    ])
                    ->notRegex('/.(<script|<style>).+/i')
                    ->required()
            ])
            ->required();
    }

    protected function faq()
    {
        return Repeater::make('faq')
            ->schema([
                TextInput::make('question')
                    ->required(),
                Textarea::make('answer')
                    ->notRegex('/.(<script|<style>).+/i')
                    ->required()
            ])
            ->required();
    }
}


