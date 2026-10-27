<?php

namespace App\Filament\Resources\Clientes\Schemas;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ClienteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos personales')
                    ->schema([
                        TextInput::make('nombre')->required(),
                        TextInput::make('apellidos')->required(),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('telefono')->tel(),
                    ])
                    ->columns(2),
                Section::make('Dirección')
                    ->schema([
                        Textarea::make('direccion')->columnSpanFull(),
                        TextInput::make('ciudad'),
                        TextInput::make('codigo_postal'),
                    ])
                    ->columns(2),
                Section::make('Gestión')
                    ->schema([
                        Select::make('user_id')
                            ->label('Gestionado por')
                            ->options(User::all()->pluck('name', 'id'))
                            ->required()
                            ->searchable(),
                        Textarea::make('notas')->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
