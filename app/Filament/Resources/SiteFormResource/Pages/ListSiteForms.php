<?php

namespace App\Filament\Resources\SiteFormResource\Pages;

use App\Filament\Resources\SiteFormResource;
use Exception;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiteForms extends ListRecords
{
    protected static string $resource = SiteFormResource::class;

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
