<?php

namespace App\Filament\Resources\Provinces\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProvinceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Kode Provinsi')
                    ->required()
                    ->maxLength(2),
                TextInput::make('name')
                    ->label('Nama Provinsi')
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }
}
