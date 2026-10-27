<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->string('nombre', 100);
            $table->enum('tipo', ['smartphone', 'tablet', 'laptop', 'desktop', 'otros'])->default('otros');
            $table->string('marca', 50)->nullable();
            $table->string('modelo', 100)->nullable();
            $table->string('numero_serie', 100)->unique();
            $table->enum('estado', ['activo', 'inactivo', 'reparacion', 'baja'])->default('activo');
            $table->date('fecha_compra')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispositivos');
    }
};
