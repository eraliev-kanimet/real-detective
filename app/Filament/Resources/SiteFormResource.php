<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteFormResource\Pages;
use App\Models\SiteForm;
use Exception;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SiteFormResource extends Resource
{
    protected static ?string $model = SiteForm::class;
    protected static ?string $navigationLabel = 'Данные из формы';
    protected static ?string $breadcrumb = 'Данные из формы';
    protected static ?string $pluralLabel = 'Данные из формы';
    protected static ?string $modelLabel = '';
    protected static ?int $navigationSort = 9;
    protected static ?string $navigationIcon = 'heroicon-o-inbox-in';

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('data.name')
                    ->label('Имя'),
                Tables\Columns\TextColumn::make('data.number')
                    ->label('Телефон'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Дата последнего изменения')
                    ->dateTime('M j, Y')
                    ->sortable()
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
            'index' => Pages\ListSiteForms::route('/'),
            'edit' => Pages\EditSiteForm::route('/{record}/edit'),
        ];
    }
}
