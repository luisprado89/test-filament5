<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = User::where('role', 'user')->get();
        $nombres = ['Juan', 'María', 'Carlos', 'Ana', 'Luis', 'Laura', 'Pedro', 'Sofía', 'Miguel', 'Elena'];
        $apellidos = ['García', 'Martínez', 'López', 'Sánchez', 'Rodríguez', 'González', 'Fernández', 'Ruiz', 'Pérez', 'Gómez'];
        $ciudades = ['Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Bilbao', 'Zaragoza', 'Málaga', 'Murcia'];

        for ($i = 1; $i <= 20; $i++) {
            $nombre = $nombres[array_rand($nombres)];
            $apellido = $apellidos[array_rand($apellidos)];

            Cliente::create([
                'nombre' => $nombre,
                'apellidos' => $apellido,
                'email' => strtolower(Str::slug($nombre.'.'.$apellido)).$i.'@email.com',
                'telefono' => '6'.rand(10000000, 99999999),
                'direccion' => 'Calle '.rand(1, 100).', Nº '.rand(1, 50),
                'ciudad' => $ciudades[array_rand($ciudades)],
                'codigo_postal' => str_pad(rand(1000, 9999), 5, '0', STR_PAD_LEFT),
                'notas' => null,
                'user_id' => $usuarios->random()->id,
            ]);
        }
    }
}
