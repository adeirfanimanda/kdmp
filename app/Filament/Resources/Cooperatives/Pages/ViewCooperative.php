<?php

namespace App\Filament\Resources\Cooperatives\Pages;

use App\Filament\Resources\Cooperatives\CooperativeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCooperative extends ViewRecord
{
    protected static string $resource = CooperativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
