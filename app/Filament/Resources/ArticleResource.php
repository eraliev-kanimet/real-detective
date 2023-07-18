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
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationLabel = 'Статьи';
    protected static ?string $breadcrumb = 'Статьи';
    protected static ?string $pluralLabel = 'Статьи';
    protected static ?string $modelLabel = 'Статья';
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
                TextColumn::make('name')->limit(25)->label('Название'),
                TextColumn::make('rating.views')->label('Просмотры'),
                TextColumn::make('rating.likes')->label('Нравится'),
                TextColumn::make('rating.dislikes')->label('Не нравится'),
                TextColumn::make('author.name')->label('Автор')->limit(13),
                TextColumn::make('created_at')->label('Дата создания')->dateTime(),
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
