<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers\SubcategoriesRelationManager;
use App\Helpers\FilamentHelper;
use App\Models\Category;
use Exception;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationLabel = 'Категории';
    protected static ?string $breadcrumb = 'Категории';
    protected static ?string $pluralLabel = 'Категории';
    protected static ?string $modelLabel = 'Категория';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-menu-alt-1';

    public static function form(Form $form): Form
    {
        $helper = new FilamentHelper();

        return $form->schema([
            $helper->grid([
                $helper->textInput('name')->label('Название'),
                $helper->select('icon', Category::$icons)->label('Иконка'),
                $helper->select('service', Category::$services)->label('Группа'),
            ], 3),
            $helper->toggle('visible', true)->label('Активный'),
        ])->columns(1);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Название'),
                TextColumn::make('service')->label('Группа')->enum(Category::$services),
                IconColumn::make('visible')->label('Активный')->boolean()
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SubcategoriesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
