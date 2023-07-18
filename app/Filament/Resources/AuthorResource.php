<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Helpers\FilamentHelper;
use App\Models\Author;
use Exception;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;
    protected static ?string $navigationLabel = 'Авторы';
    protected static ?string $breadcrumb = 'Авторы';
    protected static ?string $pluralLabel = 'Авторы';
    protected static ?string $modelLabel = 'Автор';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('articles');
    }

    public static function form(Form $form): Form
    {
        $helper = new FilamentHelper;

        return $form
            ->schema([
                $helper->grid([
                    $helper->image('image')->avatar()->label('Фото'),
                    $helper->textInput('name')->label('Имя'),
                    $helper->textInput('post')->label('Должность'),
                ], 3),
                $helper->richEditor('about')->label('О себе'),
            ])->columns(1);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Имя'),
                Tables\Columns\TextColumn::make('post')->label('Должность'),
                Tables\Columns\TextColumn::make('articles_count')
                    ->counts('articles')
                    ->label('Кол-во статей'),
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
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
