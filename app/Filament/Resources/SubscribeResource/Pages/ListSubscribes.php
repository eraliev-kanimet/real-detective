<?php

namespace App\Filament\Resources\SubscribeResource\Pages;

use App\Filament\Resources\SubscribeResource;
use Exception;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubscribes extends ListRecords
{
    protected static string $resource = SubscribeResource::class;

    /**
     * @throws Exception
     */
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
