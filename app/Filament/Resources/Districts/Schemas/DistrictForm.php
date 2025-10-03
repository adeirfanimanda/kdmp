<?php

namespace App\Filament\Resources\Districts\Schemas;

use App\Models\Province;
use App\Models\Regency;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DistrictForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('province_id')
                    ->label('Provinsi')
                    ->options(Province::query()
                        ->orderBy('name')
                        ->pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->live()
                    ->dehydrated(false)
                    ->afterStateHydrated(function ($state, callable $set, $record) {
                        if ($record && isset($record->regency_id) && $record->regency_id) {
                            $provinceId = Regency::query()
                                ->whereKey($record->regency_id)
                                ->value('province_id');
                            if ($provinceId) {
                                $set('province_id', $provinceId);
                            }
                        }
                    })
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('regency_id', null);
                    }),
                Select::make('regency_id')
                    ->label('Kabupaten/Kota')
                    ->options(function ($get) {
                        $provinceId = $get('province_id');
                        if (! $provinceId) {
                            return [];
                        }
                        return Regency::query()
                            ->where('province_id', $provinceId)
                            ->orderBy('name')
                            ->pluck('name', 'id');
                    })
                    ->required()
                    ->live()
                    ->searchable()
                    ->disabled(fn($get) => blank($get('province_id'))),
                TextInput::make('code')
                    ->label('Kode Kecamatan')
                    ->placeholder('Contoh: 360310')
                    ->required()
                    ->maxLength(7)
                    ->unique(),
                TextInput::make('name')
                    ->label('Nama Kecamatan')
                    ->placeholder('Contoh: Sukadiri')
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }
}
