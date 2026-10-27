<?php

namespace App\Filament\Resources\Dispositivos\Tables;

use App\Models\Cliente;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DispositivosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->searchable()->sortable(),
                TextColumn::make('cliente.nombre_completo')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'smartphone' => 'success',
                        'tablet' => 'info',
                        'laptop' => 'warning',
                        'desktop' => 'danger',
                        'otros' => 'gray',
                    }),
                TextColumn::make('marca')->searchable(),
                TextColumn::make('modelo'),
                TextColumn::make('estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'activo' => 'success',
                        'inactivo' => 'gray',
                        'reparacion' => 'warning',
                        'baja' => 'danger',
                    }),
                TextColumn::make('fecha_compra')->date()->sortable(),
            ])
            ->filters([
                SelectFilter::make('tipo')
                    ->options([
                        'smartphone' => 'Smartphone',
                        'tablet' => 'Tablet',
                        'laptop' => 'Laptop',
                        'desktop' => 'Desktop',
                        'otros' => 'Otros',
                    ]),
                SelectFilter::make('estado')
                    ->options([
                        'activo' => 'Activo',
                        'inactivo' => 'Inactivo',
                        'reparacion' => 'Reparación',
                        'baja' => 'Baja',
                    ]),
                SelectFilter::make('cliente_id')
                    ->label('Cliente')
                    ->options(Cliente::all()->pluck('nombre_completo', 'id')),
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
