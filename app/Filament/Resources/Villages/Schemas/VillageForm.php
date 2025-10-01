<?php

namespace App\Filament\Resources\Villages\Schemas;

use App\Models\District;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VillageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('district_id')
                    ->label('Kecamatan')
                    ->options(District::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                TextInput::make('code')
                    ->required()
                    ->maxLength(10),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }
}
