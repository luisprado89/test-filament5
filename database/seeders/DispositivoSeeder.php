<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Dispositivo;
use Illuminate\Database\Seeder;

class DispositivoSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = Cliente::all();
        $tipos = ['smartphone', 'tablet', 'laptop', 'desktop', 'otros'];
        $marcas = ['Apple', 'Samsung', 'Xiaomi', 'HP', 'Dell', 'Lenovo', 'Asus', 'Microsoft'];
        $estados = ['activo', 'inactivo', 'reparacion', 'baja'];
        $nombres = ['iPhone', 'Galaxy', 'iPad', 'MacBook', 'ThinkPad', 'Surface', 'Pixel', 'OnePlus'];

        foreach ($clientes as $cliente) {
            // 2-4 dispositivos por cliente
            $numDispositivos = rand(2, 4);

            for ($i = 1; $i <= $numDispositivos; $i++) {
                $tipo = $tipos[array_rand($tipos)];
                $marca = $marcas[array_rand($marcas)];

                Dispositivo::create([
                    'cliente_id' => $cliente->id,
                    'nombre' => $nombres[array_rand($nombres)].' '.$i,
                    'tipo' => $tipo,
                    'marca' => $marca,
                    'modelo' => $marca.'-Model-'.rand(1000, 9999),
                    'numero_serie' => 'SN-'.strtoupper(uniqid()).'-'.$cliente->id.$i,
                    'estado' => $estados[array_rand($estados)],
                    'fecha_compra' => now()->subDays(rand(30, 1000))->toDateString(),
                    'notas' => null,
                ]);
            }
        }
    }
}
