<?php

namespace App\Filament\Resources\Dispositivos;

use App\Filament\Resources\Dispositivos\Pages\CreateDispositivo;
use App\Filament\Resources\Dispositivos\Pages\EditDispositivo;
use App\Filament\Resources\Dispositivos\Pages\ListDispositivos;
use App\Filament\Resources\Dispositivos\Schemas\DispositivoForm;
use App\Filament\Resources\Dispositivos\Tables\DispositivosTable;
use App\Models\Dispositivo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DispositivoResource extends Resource
{
    protected static ?string $model = Dispositivo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function form(Schema $schema): Schema
    {
        return DispositivoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DispositivosTable::configure($table);
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
            'index' => ListDispositivos::route('/'),
            'create' => CreateDispositivo::route('/create'),
            'edit' => EditDispositivo::route('/{record}/edit'),
        ];
    }
}
