<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubcategoryResource\Pages;
use App\Filament\Resources\SubcategoryResource\SubcategoryForm;
use App\Models\Page;
use App\Models\Subcategory;
use Exception;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SubcategoryResource extends Resource
{
    protected static ?string $model = Subcategory::class;
    protected static ?string $navigationLabel = 'Услуги';
    protected static ?string $breadcrumb = 'Услуги';
    protected static ?string $pluralLabel = 'Услуги';
    protected static ?string $modelLabel = 'Услуга';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-view-grid';

    public static function form(Form $form): Form
    {
        $contract_types = [];

        foreach (Page::first()->seo['contract_types'] as $type) {
            $contract_types[$type] = $type;
        }

        return $form->schema(SubcategoryForm::form($contract_types))->columns(1);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Название'),
                Tables\Columns\TextColumn::make('contract_type')->label('Тип контракта'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubcategories::route('/'),
            'create' => Pages\CreateSubcategory::route('/create'),
            'edit' => Pages\EditSubcategory::route('/{record}/edit'),
        ];
    }
}
