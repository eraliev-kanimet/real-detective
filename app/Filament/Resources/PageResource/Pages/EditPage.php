<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Exception;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;
    protected static ?string $title = 'Изменение конфигурации сайта';

    public function getBreadcrumb(): string
    {
        return self::$title;
    }

    /**
     * @throws Exception
     */
    protected function getActions(): array
    {
        return [];
    }
}
