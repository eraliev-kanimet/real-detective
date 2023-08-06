<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Helpers\FilamentHelper;
use App\Models\Review;
use Exception;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;
    protected static ?string $navigationLabel = 'Отзывы';
    protected static ?string $breadcrumb = 'Отзывы';
    protected static ?string $pluralLabel = 'Отзывы';
    protected static ?string $modelLabel = 'Отзыв';
    protected static ?int $navigationSort = 6;
    protected static ?string $navigationIcon = 'heroicon-o-chat-alt';

    public static function form(Form $form): Form
    {
        $helper = new FilamentHelper();

        return $form->schema([
            $helper->grid([
                $helper->textInput('name')->label('Имя'),
                $helper->numericInputWithMinMaxValue('rating', 0, 5)->label('Оценка'),
                $helper->textInputNullable('url')->label('URL')->columnSpan(2),
            ], 4),
            $helper->textarea('content')->label('Текст'),
        ])->columns(1);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Название'),
                Tables\Columns\TextColumn::make('rating')->label('Оценка'),
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
