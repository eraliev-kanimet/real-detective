<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\ArticleResourceForm;
use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Exception;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['rating', 'author']);
    }

    public static function form(Form $form): Form
    {
        return $form->schema(ArticleResourceForm::form())->columns(1);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->limit(25),
                Tables\Columns\TextColumn::make('rating.views'),
                Tables\Columns\TextColumn::make('rating.likes'),
                Tables\Columns\TextColumn::make('rating.dislikes'),
                Tables\Columns\TextColumn::make('author.name')->limit(13),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
