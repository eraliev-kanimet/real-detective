<?php

namespace App\Filament\Resources;

use App\Helpers\FilamentHelper;
use Exception;
use App\Models\User;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?int $navigationSort = 9;
    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    public static function form(Form $form): Form
    {
        $helper = new FilamentHelper();

        return $form->schema([
            $helper->textInput('name'),
            $helper->textInput('email')
                ->email()
                ->unique(User::class, 'email'),
            $helper->textInput('password')
                ->password()
                ->maxLength(255)
                ->dehydrateStateUsing(static function ($state) use ($form) {
                    if (!empty($state)) {
                        return Hash::make($state);
                    }

                    $user = User::find($form->getColumns());
                    if ($user) {
                        return $user->password;
                    }

                    return $state;
                }),
        ])->columns(3);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime('M j, Y')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime('M j, Y')->sortable(),
            ]);

        return $table;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
