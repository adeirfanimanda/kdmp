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
                    ->required()
                    ->maxLength(4),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }
}
