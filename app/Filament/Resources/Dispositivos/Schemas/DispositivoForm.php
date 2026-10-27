<?php

namespace App\Filament\Resources\Dispositivos\Schemas;

use App\Models\Cliente;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DispositivoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos del dispositivo')
                    ->schema([
                        Select::make('cliente_id')
                            ->label('Cliente')
                            ->options(Cliente::all()->pluck('nombre_completo', 'id'))
                            ->required()
                            ->searchable(),
                        TextInput::make('nombre')->required(),
                        Select::make('tipo')
                            ->options([
                                'smartphone' => 'Smartphone',
                                'tablet' => 'Tablet',
                                'laptop' => 'Laptop',
                                'desktop' => 'Desktop',
                                'otros' => 'Otros',
                            ])
                            ->required(),
                        TextInput::make('marca'),
                        TextInput::make('modelo'),
                        TextInput::make('numero_serie')
                            ->label('Nº de serie')
                            ->required()
                            ->unique(ignoreRecord: true),
                    ])
                    ->columns(2),
                Section::make('Estado y fechas')
                    ->schema([
                        Select::make('estado')
                            ->options([
                                'activo' => 'Activo',
                                'inactivo' => 'Inactivo',
                                'reparacion' => 'Reparación',
                                'baja' => 'Baja',
                            ])
                            ->required(),
                        DatePicker::make('fecha_compra'),
                        Textarea::make('notas')->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
