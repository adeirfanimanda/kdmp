<?php

namespace App\Filament\Resources\Regencies\Schemas;

use App\Models\Province;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RegencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('province_id')
                    ->label('Provinsi')
                    ->options(Province::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                TextInput::make('code')
                    ->label('Kode Kabupaten/Kota')
                    ->placeholder('Contoh: 3603')
                    ->required()
                    ->maxLength(4)
                    ->unique(),
                TextInput::make('name')
                    ->label('Nama Kabupaten/Kota')
                    ->placeholder('Contoh: Tangerang')
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }
}
