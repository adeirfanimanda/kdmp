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
                    ->placeholder('Contoh: 36')
                    ->required()
                    ->maxLength(2)
                    ->unique(),
                TextInput::make('name')
                    ->label('Nama Provinsi')
                    ->placeholder('Contoh: Banten')
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }
}
