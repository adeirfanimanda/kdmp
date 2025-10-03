<?php

namespace App\Filament\Resources\Villages\Schemas;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VillageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('province_id')
                    ->label('Provinsi')
                    ->options(Province::query()->orderBy('name')->pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->live()
                    ->dehydrated(false)
                    ->afterStateHydrated(function ($state, callable $set, $record) {
                        if ($state) {
                            return;
                        }
                        if ($record && $record->district_id) {
                            $district = District::with('regency:id,province_id')->find($record->district_id);
                            if ($district && $district->regency) {
                                $set('province_id', $district->regency->province_id);
                            }
                        }
                    })
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('regency_id', null);
                        $set('district_id', null);
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
                    ->searchable()
                    ->preload()
                    ->live()
                    ->dehydrated(false)
                    ->disabled(fn($get) => blank($get('province_id')))
                    ->afterStateHydrated(function ($state, callable $set, $record) {
                        if ($state) {
                            return;
                        }
                        if ($record && $record->district_id) {
                            $district = District::select('regency_id')->find($record->district_id);
                            if ($district && $district->regency_id) {
                                $set('regency_id', $district->regency_id);
                            }
                        }
                    })
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('district_id', null);
                    }),
                Select::make('district_id')
                    ->label('Kecamatan')
                    ->options(function ($get) {
                        $regencyId = $get('regency_id');
                        if (! $regencyId) {
                            return [];
                        }
                        return District::query()
                            ->where('regency_id', $regencyId)
                            ->orderBy('name')
                            ->pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->required()
                    ->disabled(fn($get) => blank($get('regency_id'))),
                TextInput::make('code')
                    ->label('Kode Desa/Kelurahan')
                    ->placeholder('Contoh: 3603102001')
                    ->required()
                    ->maxLength(10)
                    ->unique(),
                TextInput::make('name')
                    ->label('Nama Desa/Kelurahan')
                    ->placeholder('Contoh: Kosambi')
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }
}
