<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dispositivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 'nombre', 'tipo', 'marca', 'modelo',
        'numero_serie', 'estado', 'fecha_compra', 'notas',
    ];

    protected $casts = [
        'fecha_compra' => 'date',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
}
