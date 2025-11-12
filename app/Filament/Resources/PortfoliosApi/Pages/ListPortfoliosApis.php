<?php

namespace App\Filament\Resources\PortfoliosApi\Pages;

use App\Filament\Resources\PortfoliosApi\PortfoliosApiResource;
use Filament\Resources\Pages\ListRecords;

class ListPortfoliosApis extends ListRecords
{
    protected static string $resource = PortfoliosApiResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $user = auth()->user();

        if ($user) {
            $this->redirect(PortfoliosApiResource::getUrl('edit', ['record' => $user]));
        }
    }
}