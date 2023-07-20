<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsletterResource\Pages;
use App\Helpers\FilamentHelper;
use App\Models\Newsletter;
use Exception;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class NewsletterResource extends Resource
{
    protected static ?string $model = Newsletter::class;
    protected static ?string $navigationLabel = 'Рассылки';
    protected static ?string $breadcrumb = 'Рассылки';
    protected static ?string $pluralLabel = 'Рассылки';
    protected static ?string $modelLabel = 'Рассылка';
    protected static ?int $navigationSort = 9;
    protected static ?string $navigationIcon = 'heroicon-o-inbox-in';

    public static function form(Form $form): Form
    {
        $helper = new FilamentHelper();

        return $form
            ->schema([
                $helper->textInput('template')
                    ->label('Название шаблона'),
                $helper->textInput('subject')
                    ->label('Тема'),
                $helper->grid([
                    $helper->markdown('content')
                        ->label('Контент')
                        ->required(),
                ], 1),
                $helper->toggle('start_now')
                    ->label('Запустить сейчас')
                    ->default(true)
                    ->hidden(fn(null|Model $record): null|Model => $record)
            ])->columns(2);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('template')->label('Шаблон'),
                Tables\Columns\TextColumn::make('updated_at')->label('Последнее изменение'),
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
            'index' => Pages\ListNewsletters::route('/'),
            'create' => Pages\CreateNewsletter::route('/create'),
            'edit' => Pages\EditNewsletter::route('/{record}/edit'),
        ];
    }
}
