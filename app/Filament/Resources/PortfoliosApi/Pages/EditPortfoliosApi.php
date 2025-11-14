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
        return [];
    }

    protected function getRedirectUrl(): ?string
    {
        // Selalu tetap di halaman edit setelah menyimpan
        return static::getResource()::getUrl('edit', ['record' => $this->record]);
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
    }

    public function getTitle(): string
    {
        return 'Portfolio API';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
}
