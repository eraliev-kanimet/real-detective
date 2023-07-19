<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscribeResource\Pages;
use App\Models\Subscribe;
use Exception;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SubscribeResource extends Resource
{
    protected static ?string $model = Subscribe::class;
    protected static ?string $navigationLabel = 'Подписки';
    protected static ?string $breadcrumb = 'Подписки';
    protected static ?string $pluralLabel = 'Подписки';
    protected static ?string $modelLabel = 'Подписка';
    protected static ?int $navigationSort = 10;
    protected static ?string $navigationIcon = 'heroicon-o-pencil-alt';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('email')->email()->required()
        ])->columns(1);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('created_at')->label('Дата отправки'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscribes::route('/'),
            'create' => Pages\CreateSubscribe::route('/create'),
        ];
    }
}
