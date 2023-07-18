<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use Exception;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class SubcategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'subcategories';
    protected static ?string $title = 'Услуги';

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
            ->headerActions([
                Tables\Actions\CreateAction::make()->url(route('filament.resources.subcategories.create')),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->action(function (Model $record) {
                        redirect()->route('filament.resources.subcategories.edit', $record);
                    })->label('Изменить'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
