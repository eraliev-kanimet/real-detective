<?php

namespace App\Filament\Resources\NewsletterResource\Pages;

use App\Filament\Resources\NewsletterResource;
use App\Jobs\NewsletterJob;
use App\Models\Newsletter;
use Exception;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditNewsletter extends EditRecord
{
    protected static string $resource = NewsletterResource::class;

    /**
     * @var Newsletter
     */
    public $record;

    /**
     * @throws Exception
     */
    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * @throws Exception
     */
    protected function getFormActions(): array
    {
        return [
            Action::make('save_and_start')
                ->label('Сохранить и Запустить')
                ->action('save_and_start'),
            Action::make('save')
                ->label('Сохранить')
                ->submit('save')
                ->keyBindings(['mod+s'])
        ];
    }

    public function save_and_start(): void
    {
        $this->notify('success', 'Отправлено');

        $this->save();

        NewsletterJob::dispatch($this->record);
    }
}
