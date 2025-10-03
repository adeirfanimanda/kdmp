<?php

namespace App\Filament\Resources\Cooperatives\Pages;

use App\Filament\Resources\Cooperatives\CooperativeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCooperatives extends ListRecords
{
    protected static string $resource = CooperativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
