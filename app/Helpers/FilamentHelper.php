<?php

namespace App\Helpers;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

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

    public function textarea(string $model)
    {
        return Textarea::make($model)->required();
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
}
