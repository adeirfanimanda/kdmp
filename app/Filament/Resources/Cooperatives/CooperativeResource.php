<?php

namespace App\Filament\Resources\Cooperatives;

use App\Filament\Resources\Cooperatives\Pages\CreateCooperative;
use App\Filament\Resources\Cooperatives\Pages\EditCooperative;
use App\Filament\Resources\Cooperatives\Pages\ListCooperatives;
use App\Filament\Resources\Cooperatives\Pages\ViewCooperative;
use App\Filament\Resources\Cooperatives\Schemas\CooperativeForm;
use App\Filament\Resources\Cooperatives\Schemas\CooperativeInfolist;
use App\Filament\Resources\Cooperatives\Tables\CooperativesTable;
use App\Models\Cooperative;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class CooperativeResource extends Resource
{
    protected static ?string $model = Cooperative::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Koperasi';

    protected static string | UnitEnum | null $navigationGroup = 'Data Koperasi';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Jumlah total koperasi yang terdaftar';
    }

    public static function form(Schema $schema): Schema
    {
        return CooperativeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CooperativeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CooperativesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCooperatives::route('/'),
            'create' => CreateCooperative::route('/create'),
            'view' => ViewCooperative::route('/{record}'),
            'edit' => EditCooperative::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
