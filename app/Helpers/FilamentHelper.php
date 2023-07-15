<?php

namespace App\Helpers;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Collection;

class FilamentHelper
{
    public function tabs(array $tabs)
    {
        return Tabs::make('')->tabs($tabs);
    }

    public function tab(string $header, array $schema)
    {
        return Tabs\Tab::make($header)->schema($schema);
    }

    public function textInput(string $model)
    {
        return TextInput::make($model)->required();
    }

    public function textInputNullable(string $model)
    {
        return TextInput::make($model)->nullable();
    }

    public function textarea(string $model)
    {
        return Textarea::make($model)->notRegex('/.(<script|<style>).+/i')->required();
    }

    public function textareaNullable(string $model)
    {
        return Textarea::make($model)->notRegex('/.(<script|<style>).+/i')->nullable();
    }

    public function repeater(string $model, array $schema)
    {
        return Repeater::make($model)->schema($schema);
    }

    public function fieldset(string $header, array $schema, int $columns = 1)
    {
        return Fieldset::make($header)->schema($schema)->columns($columns);
    }

    public function richEditor(string $model)
    {
        return RichEditor::make($model)
            ->disableToolbarButtons([
                'attachFiles',
                'codeBlock',
            ])
            ->notRegex('/.(<script|<style>).+/i')
            ->required();
    }

    public function tags(string $model)
    {
        return TagsInput::make($model)->required();
    }

    public function toggle(string $model, bool $default = false)
    {
        return Toggle::make($model)
            ->default($default)
            ->required();
    }

    public function select(string $model, array|Collection $options = [])
    {
        return Select::make($model)
            ->options($options)
            ->required();
    }

    public function numericInput(string $model)
    {
        return TextInput::make($model)
            ->numeric()
            ->required();
    }

    public function numericInputWithMinValue(string $model, int $min = 0)
    {
        return $this->numericInput($model)
            ->minValue($min);
    }

    public function numericInputWithMinMaxValue(string $model, int $min, int $max)
    {
        return $this->numericInput($model)
            ->minValue($min)
            ->maxValue($max);
    }

    public function image(string $model)
    {
        return FileUpload::make($model)->image()->required();
    }

    public function builder(string $model, array $blocks)
    {
        return Builder::make($model)
            ->label('')
            ->blocks($blocks);
    }

    public function builderBlock(string $model, array $schema)
    {
        return Builder\Block::make($model)
            ->schema($schema);
    }

    public function grid(array $schema, array|int $columns = 2)
    {
        return Grid::make($columns)->schema($schema);
    }
}
