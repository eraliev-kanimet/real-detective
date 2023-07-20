<?php

namespace App\Filament\Resources\NewsletterResource\Pages;

use App\Filament\Resources\NewsletterResource;
use App\Jobs\NewsletterJob;
use App\Models\Newsletter;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsletter extends CreateRecord
{
    protected static string $resource = NewsletterResource::class;

    /**
     * @var Newsletter
     */
    public $record;

    public bool $start_now;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->start_now = $data['start_now'];

        return $data;
    }

    protected function afterCreate(): void
    {
        if ($this->start_now) {
            NewsletterJob::dispatch($this->record);
        }
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()->hidden();
    }
}
