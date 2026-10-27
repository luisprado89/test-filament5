# 🎯 Plan completo corregido: 3 proyectos idénticos con Clientes, Usuarios, Dispositivos + Seeders

Vamos a crear la misma estructura en los 3 proyectos. Como las migraciones, modelos y seeders son **Laravel puro**, el código es idéntico en los 3. Solo cambian pequeños detalles de Filament.

---

## 📋 Mapeo de puertos por proyecto

| Proyecto | Puerto | Comando artisan serve |
|----------|--------|----------------------|
| test-filament3 | 8001 | `php artisan serve --host=0.0.0.0 --port=8001` |
| test-filament4 | 8002 | `php artisan serve --host=0.0.0.0 --port=8002` |
| test-filament5 | 8003 | `php artisan serve --host=0.0.0.0 --port=8003` |

---

## ⚠️ ANTES DE EMPEZAR — Versiones de PHP en Laragon

**MUY IMPORTANTE:** Cada versión de Filament necesita una versión de PHP concreta. Si no cambias la versión de PHP en Laragon antes de instalar cada proyecto, `composer require` fallará con errores de dependencias.

### 📊 Tabla de compatibilidad

| Proyecto | Filament | Laravel | PHP mínimo | PHP recomendado |
|----------|----------|---------|------------|-----------------|
| test-filament3 | ^3.0 | 10/11 | **8.1** | 8.2 u 8.3 |
| test-filament4 | ^4.0 | 11 | **8.2** | 8.3 |
| test-filament5 | ^5.0 | 12 | **8.2** | 8.3 / 8.4 |

### 🔧 Cómo cambiar la versión de PHP en Laragon

1. Abre **Laragon**
2. Click derecho en la bandeja del sistema (icono Laragon) → **PHP** → **Version**
3. Selecciona la versión necesaria para el proyecto que vas a instalar
4. **Reinicia Laragon** (Stop → Start) para que el cambio surta efecto
5. Verifica en CMD:

```cmd
php -v
```

Debe mostrar la versión que acabas de seleccionar.

### 🔧 Si la versión de PHP que necesitas NO está en Laragon

1. Laragon → **PHP** → **Version** → **Download** (descarga la que falte)
2. Después de descargarla, selecciónala como versión activa
3. Reinicia Laragon

### 🔧 Ajuste adicional si `composer.json` exige una versión de PHP distinta

Si al hacer `composer require` te aparece un error del tipo *"Root composer.json requires php ^8.3 but your php version (8.2.x) does not satisfy that requirement"*, tienes dos opciones:

**Opción A — Cambiar la versión de PHP en Laragon** (recomendada): selecciona la versión que exige el `composer.json`.

**Opción B — Relajar la restricción de PHP en `composer.json`**: edita la línea `"php": "^8.3"` y cámbiala por la versión que tengas instalada, por ejemplo:

```json
"require": {
    "php": "^8.2",
    ...
}
```

> ⚠️ Después de editar `composer.json`, ejecuta `composer update --no-scripts` dentro del proyecto para que se regenere el `composer.lock`.

### 🔁 Flujo recomendado al cambiar entre proyectos

Cada vez que cambies de proyecto (3 → 4 → 5), revisa que la versión de PHP activa en Laragon coincide con la del proyecto en el que vas a trabajar. Si no, `composer` y `php artisan` pueden fallar.

| Cuando trabajes en... | PHP activo en Laragon |
|-----------------------|-----------------------|
| test-filament3 | 8.2 u 8.3 |
| test-filament4 | 8.3 |
| test-filament5 | 8.3 u 8.4 |

---
## ⚙️ PASO 0 (opcional) — `php.bat` por proyecto (evita cambiar PHP en Laragon)

Si no quieres cambiar la versión de PHP en Laragon cada vez que cambias de proyecto, puedes crear un archivo `php.bat` en la raíz de cada proyecto. Este archivo fuerza que al escribir `php` dentro de esa carpeta se use la versión correcta.

### `test-filament3/php.bat`
```bat
@echo off
C:\laragon\bin\php\php-8.1.34-nts-Win32-vs16-x64\php.exe %*
```

### `test-filament4/php.bat`
```bat
@echo off
C:\laragon\bin\php\php-8.2.35-1-Win32-vs16-x64\php.exe %*
```

### `test-filament5/php.bat`
```bat
@echo off
C:\laragon\bin\php\php-8.5.12-1-Win32-vs17-x64\php.exe %*
```

> ⚠️ Ajusta las rutas a las versiones que tengas realmente instaladas en `C:\laragon\bin\php\`.
> ⚠️ Este `php.bat` solo se aplica si abres CMD **dentro de la carpeta del proyecto**. Si no existe, se usará el PHP global activo en Laragon.
> ⚠️ Si NO creas `php.bat`, entonces debes cambiar la versión de PHP en Laragon manualmente antes de trabajar en cada proyecto (ver siguiente sección).
```


## 🚀 PASO 1 — Instalar Filament en los 3 proyectos

### Proyecto 1 - Filament 3
cd D:\PHP\pruebas-filament\test-filament3
```cmd
composer require filament/filament:"^3.0" -W --no-security-blocking
```
```cmd
php artisan filament:install --panels
```

### Proyecto 2 - Filament 4
cd D:\PHP\pruebas-filament\test-filament4
```cmd
composer require filament/filament:"^4.0" -W --no-security-blocking
```
```cmd
php artisan filament:install --panels
```

### Proyecto 3 - Filament 5
cd D:\PHP\pruebas-filament\test-filament5
```cmd
composer require filament/filament:"^5.0" -W
```
```cmd
php artisan filament:install --panels
```

Responde a las preguntas (iguales en los 3):
- Panel ID: `admin`
- Publish assets: `Yes`
- Create user: `No` (lo haremos con seeders)

---
## 🚀 PASO 1.2 — Configurar .env en cada proyecto

Edita el `.env` de cada proyecto con su propia base de datos:

**`test-filament3/.env`:**
```env
APP_NAME="Test Filament 3"
APP_URL=http://test-filament3.test
#APP_URL=http://192.168.1.24:8001
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test_filament3
DB_USERNAME=root
DB_PASSWORD=
```

**`test-filament4/.env`:**
```env
APP_NAME="Test Filament 4"
APP_URL=http://test-filament4.test
#APP_URL=http://192.168.1.24:8002
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test_filament4
DB_USERNAME=root
DB_PASSWORD=
```

**`test-filament5/.env`:**
```env
APP_NAME="Test Filament 5"
APP_URL=http://test-filament5.test
#APP_URL=http://192.168.1.24:8003
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test_filament5
DB_USERNAME=root
DB_PASSWORD=
```

---
---

## 🗄️ PASO 2 — Crear las 3 bases de datos (ANTES de migraciones)

> ⚠️ **Importante:** hay que crear las bases de datos ANTES de ejecutar `migrate`. Si intentas migrar sin que existan, Laravel dará error `Unknown database 'test_filament3'`.

### Opción 1 — Con Laravel (recomendada)
cd D:\PHP\pruebas-filament\test-filament3
```cmd
php artisan db:create
```

cd D:\PHP\pruebas-filament\test-filament4
```cmd
php artisan db:create
```

cd D:\PHP\pruebas-filament\test-filament5
```cmd
php artisan db:create
```

### Opción 2 — Con MySQL directamente
```cmd
"C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysql.exe" -u root -e "CREATE DATABASE IF NOT EXISTS test_filament3 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```
```cmd
"C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysql.exe" -u root -e "CREATE DATABASE IF NOT EXISTS test_filament4 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```
```cmd
"C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysql.exe" -u root -e "CREATE DATABASE IF NOT EXISTS test_filament5 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

---

## 🗄️ PASO 3 — Crear migraciones (igual en los 3 proyectos)

cd D:\PHP\pruebas-filament\test-filament3

### Crear migraciones
```cmd
php artisan make:migration add_role_to_users_table
```
```cmd
php artisan make:migration create_clientes_table
```
```cmd
php artisan make:migration create_dispositivos_table
```

> 🔁 Repite los 3 comandos dentro de `test-filament4` y `test-filament5`.

### Editar `database/migrations/YYYY_MM_DD_add_role_to_users_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'user'])->default('user')->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
```

### Editar `database/migrations/YYYY_MM_DD_create_clientes_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellidos', 100);
            $table->string('email', 150)->unique();
            $table->string('telefono', 20)->nullable();
            $table->text('direccion')->nullable();
            $table->string('ciudad', 100)->nullable();
            $table->string('codigo_postal', 10)->nullable();
            $table->text('notas')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
```

### Editar `database/migrations/YYYY_MM_DD_create_dispositivos_table.php`:

```php
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
```

---

## 🗄️ PASO 4 — Ejecutar las migraciones (sin seed todavía)

> ⚠️ Ejecutamos `migrate` AHORA (sin `--seed`) porque los seeders se crearán en el PASO 6. Esto crea las tablas para que los `make:filament-resource` del PASO 7 puedan leer las columnas reales de la BD.

### Proyecto 1
cd D:\PHP\pruebas-filament\test-filament3
```cmd
php artisan migrate
```

### Proyecto 2
cd D:\PHP\pruebas-filament\test-filament4
```cmd
php artisan migrate
```

### Proyecto 3
cd D:\PHP\pruebas-filament\test-filament5
```cmd
php artisan migrate
```

Si todo va bien verás las tablas creadas: `users` (con `role`), `clientes`, `dispositivos`.

---

## 📦 PASO 5 — Crear modelos (igual en los 3 proyectos)

```cmd
php artisan make:model Cliente
```
```cmd
php artisan make:model Dispositivo
```

> 🔁 Repite en `test-filament4` y `test-filament5`.

### Reemplazar `app/Models/Cliente.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'apellidos', 'email', 'telefono', 'direccion',
        'ciudad', 'codigo_postal', 'notas', 'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dispositivos(): HasMany
    {
        return $this->hasMany(Dispositivo::class);
    }

    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombre} {$this->apellidos}";
    }
}
```

### Reemplazar `app/Models/Dispositivo.php`:

```php
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
```

### Modificar `app/Models/User.php` — ⚠️ DISTINTO según la versión de Laravel

#### Para test-filament3 (Laravel 10 — incluye Sanctum):
```php
<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;
    //use HasFactory, Notifiable; el HasApiTokens lo quitamos despues de las versiones 3 que no vienen instalados.
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true; // o filtrar por role si quieres solo admins
    }
}
```

#### Para test-filament4 y test-filament5 (Laravel 11/12 — SIN Sanctum):
```php
<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
```

---

## 🌱 PASO 6 — Crear seeders (igual en los 3 proyectos)

```cmd
php artisan make:seeder UserSeeder
```
```cmd
php artisan make:seeder ClienteSeeder
```
```cmd
php artisan make:seeder DispositivoSeeder
```

> 🔁 Repite en `test-filament4` y `test-filament5`.

### Reemplazar `database/seeders/UserSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Usuarios normales
        $usuarios = [
            ['name' => 'Juan Pérez', 'email' => 'juan@test.com'],
            ['name' => 'María García', 'email' => 'maria@test.com'],
            ['name' => 'Carlos López', 'email' => 'carlos@test.com'],
            ['name' => 'Ana Martín', 'email' => 'ana@test.com'],
        ];

        foreach ($usuarios as $u) {
            User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }
    }
}
```

### Reemplazar `database/seeders/ClienteSeeder.php`:

```php
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
```

### Reemplazar `database/seeders/DispositivoSeeder.php`:

```php
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
```

### Reemplazar `database/seeders/DatabaseSeeder.php`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ClienteSeeder::class,
            DispositivoSeeder::class,
        ]);
    }
}
```

---

## 🎨 PASO 7 — Crear Filament Resources

### ⚠️ IMPORTANTE: Filament 3 NO es interactivo, Filament 4/5 SÍ hace preguntas

### 🅰️ test-filament3 (Filament 3) — Comando NO interactivo

cd D:\PHP\pruebas-filament\test-filament3
```cmd
php artisan make:filament-resource User
```
```cmd
php artisan make:filament-resource Cliente
```
```cmd
php artisan make:filament-resource Dispositivo
```

**Estructura generada (1 archivo por resource):**
```
app/Filament/Resources/
├── UserResource.php
├── ClienteResource.php
└── DispositivoResource.php
```

### Reemplazar `app/Filament/Resources/UserResource.php`:

```php
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Datos del usuario')->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('password')->password()->dehydrated(fn ($state) => filled($state))->required(fn (string $operation): bool => $operation === 'create'),
                Forms\Components\Select::make('role')->options(['admin' => 'Admin', 'user' => 'Usuario'])->required(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\BadgeColumn::make('role')->colors(['danger' => 'admin', 'success' => 'user']),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ])->filters([
            Tables\Filters\SelectFilter::make('role')->options(['admin' => 'Admin', 'user' => 'Usuario']),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
```

### Reemplazar `app/Filament/Resources/ClienteResource.php`:

```php
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClienteResource\Pages;
use App\Models\Cliente;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Datos personales')->schema([
                Forms\Components\TextInput::make('nombre')->required(),
                Forms\Components\TextInput::make('apellidos')->required(),
                Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('telefono')->tel(),
            ])->columns(2),
            Forms\Components\Section::make('Dirección')->schema([
                Forms\Components\Textarea::make('direccion')->columnSpanFull(),
                Forms\Components\TextInput::make('ciudad'),
                Forms\Components\TextInput::make('codigo_postal'),
            ])->columns(2),
            Forms\Components\Section::make('Gestión')->schema([
                Forms\Components\Select::make('user_id')->label('Gestionado por')->options(User::all()->pluck('name', 'id'))->required(),
                Forms\Components\Textarea::make('notas')->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('nombre_completo')->searchable(['nombre', 'apellidos'])->sortable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('telefono'),
            Tables\Columns\TextColumn::make('ciudad'),
            Tables\Columns\TextColumn::make('user.name')->label('Gestionado por')->badge(),
            Tables\Columns\TextColumn::make('dispositivos_count')->counts('dispositivos')->label('Dispositivos')->badge()->color('success'),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ])->filters([
            Tables\Filters\SelectFilter::make('user_id')->label('Gestionado por')->options(User::all()->pluck('name', 'id')),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
        ];
    }
}
```

### Reemplazar `app/Filament/Resources/DispositivoResource.php`:

```php
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DispositivoResource\Pages;
use App\Models\Cliente;
use App\Models\Dispositivo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DispositivoResource extends Resource
{
    protected static ?string $model = Dispositivo::class;
    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Datos del dispositivo')->schema([
                Forms\Components\Select::make('cliente_id')->label('Cliente')->options(Cliente::all()->pluck('nombre_completo', 'id'))->required()->searchable(),
                Forms\Components\TextInput::make('nombre')->required(),
                Forms\Components\Select::make('tipo')->options([
                    'smartphone' => 'Smartphone', 'tablet' => 'Tablet', 'laptop' => 'Laptop',
                    'desktop' => 'Desktop', 'otros' => 'Otros',
                ])->required(),
                Forms\Components\TextInput::make('marca'),
                Forms\Components\TextInput::make('modelo'),
                Forms\Components\TextInput::make('numero_serie')->label('Nº de serie')->required()->unique(ignoreRecord: true),
            ])->columns(2),
            Forms\Components\Section::make('Estado y fechas')->schema([
                Forms\Components\Select::make('estado')->options([
                    'activo' => 'Activo', 'inactivo' => 'Inactivo',
                    'reparacion' => 'Reparación', 'baja' => 'Baja',
                ])->required(),
                Forms\Components\DatePicker::make('fecha_compra'),
                Forms\Components\Textarea::make('notas')->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('nombre')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('cliente.nombre_completo')->label('Cliente')->searchable()->sortable(),
            Tables\Columns\BadgeColumn::make('tipo')->colors(['gray' => 'otros', 'success' => 'smartphone', 'info' => 'tablet', 'warning' => 'laptop', 'danger' => 'desktop']),
            Tables\Columns\TextColumn::make('marca')->searchable(),
            Tables\Columns\TextColumn::make('modelo'),
            Tables\Columns\BadgeColumn::make('estado')->colors([
                'success' => 'activo', 'gray' => 'inactivo', 'warning' => 'reparacion', 'danger' => 'baja',
            ]),
            Tables\Columns\TextColumn::make('fecha_compra')->date()->sortable(),
        ])->filters([
            Tables\Filters\SelectFilter::make('tipo')->options([
                'smartphone' => 'Smartphone', 'tablet' => 'Tablet', 'laptop' => 'Laptop',
                'desktop' => 'Desktop', 'otros' => 'Otros',
            ]),
            Tables\Filters\SelectFilter::make('estado')->options([
                'activo' => 'Activo', 'inactivo' => 'Inactivo',
                'reparacion' => 'Reparación', 'baja' => 'Baja',
            ]),
            Tables\Filters\SelectFilter::make('cliente_id')->label('Cliente')->options(Cliente::all()->pluck('nombre_completo', 'id')),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDispositivos::route('/'),
            'create' => Pages\CreateDispositivo::route('/create'),
            'edit' => Pages\EditDispositivo::route('/{record}/edit'),
        ];
    }
}
```

---

### 🅱️ test-filament4 y test-filament5 (Filament 4/5) — Comando INTERACTIVO

### En test-filament4
cd D:\PHP\pruebas-filament\test-filament4
```cmd
php artisan make:filament-resource User
```
```cmd
php artisan make:filament-resource Cliente
```
```cmd
php artisan make:filament-resource Dispositivo
```

### En test-filament5 (lo mismo)
cd D:\PHP\pruebas-filament\test-filament5
```cmd
php artisan make:filament-resource User
```
```cmd
php artisan make:filament-resource Cliente
```
```cmd
php artisan make:filament-resource Dispositivo
```

#### 📝 Preguntas interactivas y respuestas (para cada resource):

| Pregunta | User | Cliente | Dispositivo |
|----------|------|---------|-------------|
| `What is the title attribute for this model?` | `name` | `nombre_completo` | `nombre` |
| `Would you like to generate a read-only view page?` | `no` | `no` | `no` |
| `Should the configuration be generated from the current database columns?` | `yes` | `yes` | `yes` |
| `XxxFile.php already exists, overwrite?` | `yes` | `yes` | `yes` |

> ⚠️ La pregunta *"Should the configuration be generated from the current database columns?"* SOLO funciona si ya has ejecutado `php artisan migrate` (PASO 4). Si las tablas no existen, Filament no puede leer las columnas y generará archivos vacíos.

**Estructura generada (archivos separados):**
```
app/Filament/Resources/
├── Users/
│   ├── UserResource.php
│   ├── Pages/ (List, Create, Edit)
│   ├── Schemas/UserForm.php        ← aquí va el formulario
│   └── Tables/UsersTable.php       ← aquí va la tabla
├── Clientes/
│   ├── ClienteResource.php
│   ├── Pages/
│   ├── Schemas/ClienteForm.php
│   └── Tables/ClientesTable.php
└── Dispositivos/
    ├── DispositivoResource.php
    ├── Pages/
    ├── Schemas/DispositivoForm.php
    └── Tables/DispositivosTable.php
```

#### `app/Filament/Resources/Users/Schemas/UserForm.php`
```php
<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos del usuario')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('password')
                            ->password()
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create'),
                        Select::make('role')
                            ->label('Rol')
                            ->options([
                                'admin' => 'Admin',
                                'user' => 'Usuario',
                            ])
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
```

#### `app/Filament/Resources/Users/Tables/UsersTable.php`
```php
<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'user' => 'success',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'Usuario',
                    ]),
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
```

#### `app/Filament/Resources/Clientes/Schemas/ClienteForm.php`
```php
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
```

#### `app/Filament/Resources/Clientes/Tables/ClientesTable.php`
```php
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
```

#### `app/Filament/Resources/Dispositivos/Schemas/DispositivoForm.php`
```php
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
```

#### `app/Filament/Resources/Dispositivos/Tables/DispositivosTable.php`
```php
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
```

---

---

## 🚀 PASO 8 — Ejecutar `migrate:fresh --seed` en cada proyecto

Ahora sí, con los seeders ya creados y el `.env` apuntando a la BD correcta.

### Proyecto 1
cd D:\PHP\pruebas-filament\test-filament3
```cmd
php artisan migrate:fresh --seed
```

### Proyecto 2
cd D:\PHP\pruebas-filament\test-filament4
```cmd
php artisan migrate:fresh --seed
```

### Proyecto 3
cd D:\PHP\pruebas-filament\test-filament5
```cmd
php artisan migrate:fresh --seed
```

Cada uno creará:
- ✅ 5 usuarios (1 admin + 4 normales)
- ✅ 20 clientes
- ✅ ~60 dispositivos (2-4 por cliente)

---

## 🌐 PASO 10 — Probar en el navegador (PC)

Asegúrate de que Laragon está arrancado y abre:

| Proyecto | URL | Login |
|----------|-----|-------|
| Filament 3 | http://test-filament3.test/admin | admin@test.com / admin123 |
| Filament 4 | http://test-filament4.test/admin | admin@test.com / admin123 |
| Filament 5 | http://test-filament5.test/admin | admin@test.com / admin123 |

---

## 📱 PASO 11 — Probar en el navegador desde el móvil

### Proyecto 1
cd D:\PHP\pruebas-filament\test-filament3
```cmd
php artisan serve --host=0.0.0.0 --port=8001
```

### Proyecto 2
cd D:\PHP\pruebas-filament\test-filament4
```cmd
php artisan serve --host=0.0.0.0 --port=8002
```

### Proyecto 3
cd D:\PHP\pruebas-filament\test-filament5
```cmd
php artisan serve --host=0.0.0.0 --port=8003
```

---

## 🔄 Flujos completos: PC ↔ Móvil

Aquí tienes las 2 opciones claramente separadas y corregidas.

---

### 📱 OPCIÓN A: Cambiar de PC → Móvil

```
┌─────────────────────────────────────────────────────────┐
│  MODO PC → MODO MÓVIL                                   │
│                                                         │
│  1. Editar .env:                                        │
│       #APP_URL=http://test-filament3.test     ← coment  │
│       APP_URL=http://192.168.1.24:8001        ← activo  │
│                                                         │
│  2. php artisan optimize:clear                          │
│                                                         │
│  3. Arrancar servidor:                                  │
│     php artisan serve --host=0.0.0.0 --port=8001        │
│     (dejar la terminal abierta)                         │
│                                                         │
│  4. Laragon: SIGUE ENCENDIDO (Apache + MySQL) ✅        │
│                                                         │
│  5. Móvil (misma WiFi):                                 │
│     http://192.168.1.24:8001/admin                      │
└─────────────────────────────────────────────────────────┘
```

### Comandos en orden:
### 1. (Editar .env manualmente en VS Code)

### 2. Limpiar caché
```cmd
php artisan optimize:clear
```

### 3. Arrancar servidor para móvil
```cmd
php artisan serve --host=0.0.0.0 --port=8001
```

---

### 🖥️ OPCIÓN B: Cambiar de Móvil → PC

```
┌─────────────────────────────────────────────────────────┐
│  MODO MÓVIL → MODO PC                                   │
│                                                         │
│  1. Parar servidor:                                     │
│     Ctrl+C en la terminal de artisan serve              │
│                                                         │
│  2. Editar .env:                                        │
│       APP_URL=http://test-filament3.test      ← activo  │
│       #APP_URL=http://192.168.1.24:8001       ← coment  │
│                                                         │
│  3. php artisan optimize:clear                          │
│                                                         │
│  4. Laragon: SIGUE ENCENDIDO (Apache + MySQL) ✅        │
│                                                         │
│  5. Navegador PC:                                       │
│     http://test-filament3.test/admin                    │
└─────────────────────────────────────────────────────────┘
```

### Comandos en orden:
### 1. Ctrl+C en la terminal (parar artisan serve)

### 2. (Editar .env manualmente en VS Code)

### 3. Limpiar caché
```cmd
php artisan optimize:clear
```

### 4. (Laragon ya está encendido, no hacer nada)

### 5. Abrir en navegador: http://test-filament3.test/admin

---

## 📊 Comparación rápida de los 2 flujos

| Paso | PC → Móvil | Móvil → PC |
|------|------------|------------|
| **1** | Editar `.env` (activar IP) | `Ctrl+C` en terminal |
| **2** | `php artisan optimize:clear` | Editar `.env` (activar .test) |
| **3** | `php artisan serve --host=0.0.0.0 --port=8001` | `php artisan optimize:clear` |
| **4** | Laragon sigue encendido ✅ | Laragon sigue encendido ✅ |
| **5** | Móvil: `http://192.168.1.24:8001/admin` | PC: `http://test-filament3.test/admin` |

---

## 🎯 Reglas de oro (siempre)

1. ✅ **Laragon NUNCA se apaga** (salvo que cierres el PC)
2. ✅ **MySQL siempre disponible** gracias a Laragon
3. ✅ **`optimize:clear` SIEMPRE después de editar `.env`**
4. ✅ **`--host=0.0.0.0`** (ceros, no ochos) para móvil
5. ✅ **Misma red WiFi** en PC y móvil
6. ✅ **Cambiar versión de PHP en Laragon** antes de instalar/cambiar de proyecto
7. ✅ **Crear la BD antes de migrar**
8. ✅ **Migrar antes de generar los Filament Resources** (para que Filament 4/5 lea las columnas reales)

---

## 📋 Datos que tendrás en cada proyecto

### Usuarios:
- **admin@test.com** / `admin123` (rol: admin)
- juan@test.com / `password` (rol: user)
- maria@test.com / `password` (rol: user)
- carlos@test.com / `password` (rol: user)
- ana@test.com / `password` (rol: user)

### Clientes: 20 registros con datos españoles realistas

### Dispositivos: ~60 registros con marcas reales (Apple, Samsung, etc.)

---

## ⚠️ Notas sobre versiones de Filament

El código de arriba funciona para **Filament 3**. Para **Filament 4 y 5** puede haber pequeños cambios:

- `BadgeColumn` en v4/v5 puede llamarse `TextColumn::make('...')->badge()`
- Algunos métodos de `Form` y `Table` pueden cambiar

**Recomendación:** Empieza con test-filament3. Si funciona, replica a los otros 2. Si hay errores de sintaxis en Filament 4/5, pégame el error y te doy el código ajustado.

---

## 🎯 Resumen de comandos para ejecutar (orden correcto)

```cmd
:: 0. ANTES DE TODO: cambiar versión PHP en Laragon según el proyecto

:: 1. Instalar Filament en los 3
cd D:\PHP\pruebas-filament\test-filament3 && composer require filament/filament:"^3.0" -W --no-security-blocking && php artisan filament:install --panels
cd D:\PHP\pruebas-filament\test-filament4 && composer require filament/filament:"^4.0" -W --no-security-blocking && php artisan filament:install --panels
cd D:\PHP\pruebas-filament\test-filament5 && composer require filament/filament:"^5.0" -W && php artisan filament:install --panels

:: 2. Crear BDs (ANTES de migrar)
"C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysql.exe" -u root -e "CREATE DATABASE IF NOT EXISTS test_filament3 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; CREATE DATABASE IF NOT EXISTS test_filament4 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; CREATE DATABASE IF NOT EXISTS test_filament5 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

:: 3. Crear migraciones + modelos + seeders en cada proyecto (make:...)

:: 4. Pegar el código de migraciones y modelos en VS Code

:: 5. Migrar (sin seed todavía) para que Filament 4/5 lea las columnas
cd D:\PHP\pruebas-filament\test-filament3 && php artisan migrate
cd D:\PHP\pruebas-filament\test-filament4 && php artisan migrate
cd D:\PHP\pruebas-filament\test-filament5 && php artisan migrate

:: 6. Crear Filament Resources (v3 no interactivo; v4/v5 interactivo)
:: (ejecutar make:filament-resource en cada carpeta)

:: 7. Crear y pegar seeders

:: 8. Configurar .env de cada proyecto + optimize:clear

:: 9. Poblar la BD con seeders
cd D:\PHP\pruebas-filament\test-filament3 && php artisan migrate:fresh --seed
cd D:\PHP\pruebas-filament\test-filament4 && php artisan migrate:fresh --seed
cd D:\PHP\pruebas-filament\test-filament5 && php artisan migrate:fresh --seed
```

---

## 📋 Errores comunes y su solución

| Error | Causa | Solución |
|-------|-------|----------|
| `Unknown database 'test_filament3'` | No has creado la BD | Ejecutar PASO 2 (crear BD) |
| `Base table or view not found` en Filament 4/5 al generar resources | No has migrado antes de `make:filament-resource` | Ejecutar PASO 4 (`php artisan migrate`) |
| `Composer could not find a version...` | Versión de PHP incorrecta en Laragon | Cambiar PHP en Laragon (sección inicial) |
| `Root composer.json requires php ^8.3` | El `composer.json` pide una versión superior a la instalada | Cambiar PHP en Laragon o relajar `"php": "^8.2"` en `composer.json` |
| `DNS_PROBE_FINISHED_NXDOMAIN` al abrir `.test` | Windows no conoce el dominio | Añadir al archivo `hosts` (solución más abajo) |
| `Class "Laravel\Sanctum\HasApiTokens" not found` en v4/v5 | Sanctum no está instalado en Laravel 11/12 | Usar la versión sin Sanctum del modelo User |

---

## 📝 Solución al error `DNS_PROBE_FINISHED_NXDOMAIN` (dominios `.test`)

Si al abrir `http://test-filament4.test/admin` el navegador da error de DNS:

### PASO 1 — Abrir el Bloc de notas como administrador

1. Pulsa la tecla **Windows**
2. Escribe: **bloc de notas** (o **notepad**)
3. **Botón derecho** sobre él → **Ejecutar como administrador**
4. Click en **Sí**

### PASO 2 — Abrir el archivo `hosts`

1. En el Bloc de notas: **Archivo** → **Abrir...**
2. Pega esta ruta y pulsa Enter:
   ```
   C:\Windows\System32\drivers\etc
   ```
3. Abajo a la derecha, cambia **"Documentos de texto (*.txt)"** a **"Todos los archivos (*.*)"**
4. Abre el archivo **`hosts`** (sin extensión)

### PASO 3 — Añadir las líneas al final

```
127.0.0.1   test-filament3.test
127.0.0.1   test-filament4.test
127.0.0.1   test-filament5.test
```

> Si ya ves alguna línea, no la repitas. Solo añade las que falten.

### PASO 4 — Guardar y limpiar caché DNS

- **Ctrl + S** para guardar
- Cierra el Bloc de notas
- En CMD:
```cmd
ipconfig /flushdns
```

### PASO 5 — Probar de nuevo en el navegador

```
http://test-filament4.test/admin
```

---
### 📂 Sobre el `.gitignore`

Los tres proyectos comparten el mismo `.gitignore` (basado en el de Laravel 12 / Filament 5) para mantener consistencia. Incluye reglas para ignorar dependencias (`vendor/`, `node_modules/`), secretos (`.env`, `auth.json`), assets publicados por Filament (`public/css/filament`, `public/js/filament`, `public/fonts/filament`) y archivos basura del sistema (`*.log`, `.DS_Store`, `Thumbs.db`).

Si tras clonar el proyecto faltan los estilos de Filament, regenéralos con:

```cmd
php artisan filament:assets
```
Sí, te lo comenté antes, pero te lo detallo **paso a paso y listo para copiar y pegar al final de tu README**, incluyendo las variantes según la versión de Filament y el detalle de los assets.

Este es el bloque exacto que deberías añadir al final de **cada uno de los 3 README**:

---

---

## 🚀 Instalación tras clonar el repositorio

Si acabas de clonar este proyecto en un PC nuevo o lo has descargado del repositorio, **no funcionará directamente**. Sigue estos pasos **en orden** desde la raíz del proyecto.

### 1. Instalar dependencias de PHP
```cmd
composer install
```

### 2. Crear el archivo `.env` a partir del ejemplo
```cmd
copy .env.example .env
```

### 3. Configurar la base de datos en `.env`
Abre el `.env` y edita estas líneas para que apunten a tu MySQL local (Laragon):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test_filament3
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Crear la base de datos en MySQL
```cmd
php artisan db:create
```

### 5. Generar la clave de la aplicación
```cmd
php artisan key:generate
```

### 6. Ejecutar migraciones y seeders
```cmd
php artisan migrate:fresh --seed
```

### 7. Regenerar los assets de Filament
Los assets (`css`, `js`, `fonts`) están ignorados por `.gitignore` y hay que regenerarlos:
```cmd
php artisan filament:assets
```

### 8. (Solo si el proyecto usa Vite/NPM) Instalar y compilar assets
Si el proyecto tiene `package.json` con dependencias, ejecuta:
```cmd
npm install
npm run build
```

### 9. Arrancar el servidor
```cmd
php artisan serve
```

Y abre en el navegador:
```
http://127.0.0.1:8000/admin
```

Login de prueba:
- **Email:** `admin@test.com`
- **Password:** `admin123`

---

### ⚠️ Antes de empezar: comprueba la versión de PHP

Cada proyecto necesita una versión distinta de PHP:

| Proyecto | Filament | PHP mínimo |
|----------|----------|------------|
| test-filament3 | ^3.0 | 8.1 |
| test-filament4 | ^4.0 | 8.2 |
| test-filament5 | ^5.0 | 8.2 |

Verifica tu versión con:
```cmd
php -v
```

Si no coincide, cambia la versión en Laragon (**PHP → Versión**) o usa un `php.bat` en la raíz del proyecto apuntando a la versión correcta.

---

### ⚠️ Si al hacer `composer install` aparece un error de versión de PHP

Puede pasar por dos motivos:

**A) La versión de PHP activa no cumple los requisitos del `composer.json`.**  
Solución: cambia la versión en Laragon o en tu `php.bat`.

**B) El `composer.json` pide una versión más nueva de la que tienes.**  
Solución: edita la línea `"php": "^8.2"` del `composer.json` para rebajarla a la que tengas, o añade `"platform-check": false` en la sección `"config"` (menos recomendado).

---

### ⚠️ Si los estilos del panel de Filament no cargan

Si ves el panel sin CSS o sin JS, ejecuta de nuevo:
```cmd
php artisan filament:assets
```
Esto regenera los archivos en `public/css/filament`, `public/js/filament` y `public/fonts/filament`, que están excluidos del repositorio.
```

---

### 🎯 Resumen rápido para tu memoria

| Comando | ¿Para qué sirve? |
|---------|------------------|
| `composer install` | Instala dependencias PHP (no están en el repo) |
| `copy .env.example .env` | Crea el archivo de configuración |
| `php artisan db:create` | Crea la BD si no existe |
| `php artisan key:generate` | Genera la clave de la app |
| `php artisan migrate:fresh --seed` | Crea tablas y mete los datos de prueba |
| `php artisan filament:assets` | Regenera CSS/JS/fuentes de Filament |
| `php artisan serve` | Arranca el servidor |

Con esto pegado al final de cada README, podrás clonar cualquiera de los tres proyectos en el futuro y **ponerlo en marcha en menos de 2 minutos** sin acordarte de nada.
