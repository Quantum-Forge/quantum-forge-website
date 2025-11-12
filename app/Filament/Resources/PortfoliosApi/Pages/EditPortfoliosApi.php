<?php

namespace App\Filament\Resources\PortfoliosApi\Pages;

use App\Filament\Resources\PortfoliosApi\PortfoliosApiResource;
use Filament\Notifications\Notification;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditPortfoliosApi extends EditRecord
{
    protected static string $resource = PortfoliosApiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generateApiKey')
                ->label('Generate API Key')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->api_key = (string) Str::uuid();
                    $this->record->api_key_created_at = now();
                    $this->form->fill($this->record->attributesToArray());
                }),
        ];
    }

    protected function getRedirectUrl(): ?string
    {
        return static::getResource()::getUrl('index');
    }

    protected function afterSave(): void
    {
        $ids = $this->record->selected_portfolio_ids ?? [];

        if (! is_array($ids) || empty($ids)) {
            Notification::make()
                ->title('Belum ada portfolio di ceklist')
                ->warning()
                ->send();
            return;
        }

        Notification::make()
            ->title('Perubahan disimpan')
            ->success()
            ->send();
    }
}