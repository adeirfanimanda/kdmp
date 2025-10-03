<?php

namespace App\Filament\Resources\Cooperatives\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class CooperativeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Koperasi')
                    ->description('Data utama koperasi')
                    ->icon('heroicon-o-building-office-2')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Koperasi')
                            ->size('lg')
                            ->weight('bold')
                            ->color('primary'),
                        TextEntry::make('legal_number')
                            ->label('Nomor Badan Hukum')
                            ->copyable()
                            ->copyMessage('Nomor badan hukum disalin!')
                            ->icon('heroicon-o-clipboard-document'),
                        TextEntry::make('address')
                            ->label('Alamat Lengkap')
                            ->columnSpanFull()
                            ->markdown()
                            ->prose(),
                    ])
                    ->collapsible(),

                Section::make('Logo Koperasi')
                    ->description('Logo resmi koperasi')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        ImageEntry::make('logo')
                            ->hiddenLabel()
                            ->imageHeight(222)
                            ->imageWidth(222)
                            ->placeholder('Tidak ada logo')
                            ->defaultImageUrl('/images/placeholder-cooperative.png'),
                    ])
                    ->collapsible(),

                Section::make('Lokasi')
                    ->description('Informasi geografis koperasi')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('village.district.regency.province.name')
                                    ->label('Provinsi')
                                    ->badge()
                                    ->color('success'),
                                TextEntry::make('village.district.regency.name')
                                    ->label('Kabupaten/Kota')
                                    ->badge()
                                    ->color('info'),
                                TextEntry::make('village.district.name')
                                    ->label('Kecamatan')
                                    ->badge()
                                    ->color('warning'),
                                TextEntry::make('village.name')
                                    ->label('Desa/Kelurahan')
                                    ->badge()
                                    ->color('primary'),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Kontak & Status')
                    ->description('Informasi kontak dan status operasional')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('phone')
                                    ->label('Nomor Telepon')
                                    ->icon('heroicon-o-phone')
                                    ->copyable()
                                    ->copyMessage('Nomor telepon disalin!'),
                                TextEntry::make('email')
                                    ->label('Email')
                                    ->icon('heroicon-o-envelope')
                                    ->copyable()
                                    ->copyMessage('Email disalin!')
                                    ->url(fn($record) => "mailto:{$record->email}"),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('established_date')
                                    ->label('Tanggal Berdiri')
                                    ->date('d F Y')
                                    ->icon('heroicon-o-calendar-days'),
                                TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn(string $state): string => match ($state) {
                                        'active' => 'success',
                                        'inactive' => 'gray',
                                        'suspended' => 'danger',
                                    })
                                    ->formatStateUsing(fn(string $state): string => match ($state) {
                                        'active' => 'Aktif',
                                        'inactive' => 'Tidak Aktif',
                                        'suspended' => 'Ditangguhkan',
                                    }),
                            ]),
                    ])
                    ->collapsible(),
            ]);
    }
}
