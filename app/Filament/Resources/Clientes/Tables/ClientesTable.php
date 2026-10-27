<?php

namespace App\Filament\Resources\Clientes\Tables;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ClientesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->searchable(['nombre', 'apellidos'])
                    ->sortable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('telefono'),
                TextColumn::make('ciudad'),
                TextColumn::make('user.name')
                    ->label('Gestionado por')
                    ->badge(),
                TextColumn::make('dispositivos_count')
                    ->counts('dispositivos')
                    ->label('Dispositivos')
                    ->badge()
                    ->color('success'),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->label('Gestionado por')
                    ->options(User::all()->pluck('name', 'id')),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
