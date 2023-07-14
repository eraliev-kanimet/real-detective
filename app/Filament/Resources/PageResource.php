<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\PageResourceForm;
use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Exception;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static ?string $navigationLabel = 'Site configuration';
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema(PageResourceForm::form())->columns(1);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        redirect()->route('filament.resources.pages.edit', [
            'record' => 1
        ]);

        return $table;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
