<?php

namespace App\Filament\Resources\Cooperatives\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class CooperativeForm
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
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('regency_id', null);
                        $set('district_id', null);
                        $set('village_id', null);
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
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('district_id', null);
                        $set('village_id', null);
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
                    ->live()
                    ->dehydrated(false)
                    ->disabled(fn($get) => blank($get('regency_id')))
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('village_id', null);
                    }),
                Select::make('village_id')
                    ->label('Desa/Kelurahan')
                    ->options(function ($get) {
                        $districtId = $get('district_id');
                        if (! $districtId) {
                            return [];
                        }
                        return Village::query()
                            ->where('district_id', $districtId)
                            ->orderBy('name')
                            ->pluck('name', 'id');
                    })
                    ->searchable()
                    ->live()
                    ->required()
                    ->disabled(fn($get) => blank($get('district_id'))),
                TextInput::make('legal_number')
                    ->label('Nomor Badan Hukum')
                    ->placeholder('AHU-0033698.AH.01.29.TAHUN 2025')
                    ->required()
                    ->maxLength(255)
                    ->unique(),
                TextInput::make('name')
                    ->label('Nama Koperasi')
                    ->placeholder('KOPERASI DESA MERAH PUTIH KOSAMBI SUKADIRI')
                    ->required()
                    ->maxLength(255),
                Textarea::make('address')
                    ->label('Alamat Koperasi')
                    ->placeholder('Jl. Raya Kosambi No. 123, Desa Kosambi, Kecamatan Sukadiri, Kabupaten Tangerang')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('phone')
                    ->label('Nomor Telepon Koperasi')
                    ->tel()
                    ->placeholder('+6281234567890')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email Koperasi')
                    ->email()
                    ->placeholder('admin@koperasikosambi.co.id')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('established_date')
                    ->label('Tanggal Berdiri')
                    ->required()
                    ->date()
                    ->columnSpanFull(),
                FileUpload::make('logo')
                    ->label('Logo Koperasi')
                    ->columnSpanFull(),
            ]);
    }
}
