<?php

namespace App\Filament\Resources\SiteFormResource\Pages;

use App\Filament\Resources\SiteFormResource;
use App\Helpers\FilamentHelper;
use Exception;
use Filament\Pages\Actions;
use Filament\Resources\Form;
use Filament\Resources\Pages\EditRecord;

class EditSiteForm extends EditRecord
{
    protected static string $resource = SiteFormResource::class;

    protected function form(Form $form): Form
    {
        $helper = new FilamentHelper;

        return $form->schema([
            $helper->textInput('data.name')
                ->label('Имя'),
            $helper->textInput('data.number')
                ->label('Телефон'),
            $helper->textareaNullable('data.question')
                ->label('Вопрос')
                ->columnSpan(2),
        ]);
    }

    /**
     * @throws Exception
     */
    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
