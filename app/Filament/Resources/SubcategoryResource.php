<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubcategoryResource\Pages;
use App\Filament\Resources\SubcategoryResource\SubcategoryForm;
use App\Models\Subcategory;
use Exception;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SubcategoryResource extends Resource
{
    protected static ?string $model = Subcategory::class;

    public static function form(Form $form): Form
    {
        $subcategoryForm = new SubcategoryForm();

        return $form->schema($subcategoryForm->form())->columns(1);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('contract_type'),
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
