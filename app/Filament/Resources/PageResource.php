<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\PageResourceForm;
use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Resources\Form;
use Filament\Resources\Resource;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static ?string $navigationLabel = 'Конфигурация сайта';
    protected static ?string $breadcrumb = 'Сайты';
    protected static ?string $pluralLabel = 'Конфигурация сайта';
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema(PageResourceForm::form())->columns(1);
    }

    public static function getPages(): array
    {
        return [
            'edit' => Pages\EditPage::route('/{record}'),
            'index' => Pages\EditPage::route('/1'),
        ];
    }
}
