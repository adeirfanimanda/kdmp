<?php

namespace App\Filament\Resources\Cooperatives\Pages;

use App\Filament\Resources\Cooperatives\CooperativeResource;
use App\Models\Village;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCooperative extends EditRecord
{
    protected static string $resource = CooperativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Pre-fill cascade values based on village_id
        if (isset($data['village_id']) && $data['village_id']) {
            $village = Village::with(['district.regency.province'])->find($data['village_id']);

            if ($village) {
                $data['province_id'] = $village->district->regency->province_id;
                $data['regency_id'] = $village->district->regency_id;
                $data['district_id'] = $village->district_id;
            }
        }

        return $data;
    }
}
