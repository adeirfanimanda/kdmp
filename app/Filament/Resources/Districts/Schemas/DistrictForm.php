<?php

namespace App\Filament\Resources\Districts\Schemas;

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
                Select::make('regency_id')
                    ->label('Kabupaten/Kota')
                    ->options(Regency::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                TextInput::make('code')
                    ->required()
                    ->maxLength(7),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }
}
