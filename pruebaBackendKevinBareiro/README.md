# API RESTful de Gestión de Productos con Multi-Divisa

## 📋 Descripción

API RESTful desarrollada en Laravel 12 para la gestión de productos con soporte multi-divisa. Permite realizar operaciones CRUD sobre productos y gestionar precios en diferentes monedas.

## 🚀 Tecnologías

- **PHP**: 8.2
- **Laravel**: 12.0
- **Base de datos**: MySQL
- **Testing**: PHPUnit 11.5
- **Contenedores**: Laravel Sail (Docker)

## 📦 Características

- ✅ CRUD completo de productos
- ✅ Gestión de precios en múltiples monedas
- ✅ Soft deletes en productos
- ✅ Validación robusta con FormRequests
- ✅ Respuestas JSON con API Resources
- ✅ Relaciones Eloquent optimizadas
- ✅ Tests automatizados
- ✅ Seeders con datos de ejemplo
- ✅ Documentación completa (Postman, Insomnia)

## 🗄️ Estructura de Base de Datos

### Tabla: `currencies`
- `id`: Primary key
- `name`: Nombre de la moneda (ej: US Dollar)
- `symbol`: Símbolo (ej: USD)
- `exchange_rate`: Tasa de cambio respecto al USD
- `timestamps`

### Tabla: `products`
- `id`: Primary key
- `name`: Nombre del producto
- `description`: Descripción
- `price`: Precio base
- `currency_id`: Foreign key a currencies (moneda base)
- `tax_cost`: Costo de impuestos
- `manufacturing_cost`: Costo de fabricación
- `timestamps`
- `deleted_at`: Soft delete

### Tabla: `product_prices`
- `id`: Primary key
- `product_id`: Foreign key a products
- `currency_id`: Foreign key a currencies
- `price`: Precio en la moneda alternativa
- `timestamps`

## 🛠️ Instalación

### Opción 1: Con Docker (Laravel Sail) - Recomendado

#### Requisitos previos
- Docker y Docker Compose instalados
- Git

#### Pasos de instalación

1. **Clonar el repositorio**
```bash
git clone <repository-url>
cd pruebaBackendKevinBareiro
```

2. **Instalar dependencias de Composer (sin Sail aún)**
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

3. **Configurar variables de entorno**
```bash
cp .env.example .env
```

4. **Levantar contenedores con Sail**
```bash
./vendor/bin/sail up -d
```

5. **Generar key de aplicación**
```bash
./vendor/bin/sail artisan key:generate
```

6. **Ejecutar migraciones**
```bash
./vendor/bin/sail artisan migrate
```

7. **Ejecutar seeders (datos de ejemplo)**
```bash
./vendor/bin/sail artisan db:seed
```

### Opción 2: Sin Docker (Instalación tradicional)

#### Requisitos previos
- PHP 8.2 o superior
- Composer
- MySQL 8.0 o superior
- Git

#### Pasos de instalación

1. **Clonar el repositorio**
```bash
git clone <repository-url>
cd pruebaBackendKevinBareiro
```

2. **Instalar dependencias**
```bash
composer install
```

3. **Configurar variables de entorno**
```bash
cp .env.example .env
```

4. **Configurar base de datos en .env**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=products_api
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

5. **Crear base de datos**
```bash
mysql -u root -p -e "CREATE DATABASE products_api;"
```

6. **Generar key de aplicación**
```bash
php artisan key:generate
```

7. **Ejecutar migraciones**
```bash
php artisan migrate
```

8. **Ejecutar seeders (datos de ejemplo)**
```bash
php artisan db:seed
```

9. **Levantar servidor de desarrollo**
```bash
php artisan serve
```

La API estará disponible en `http://localhost:8000/api`

## 🧪 Ejecutar Tests

**Con Docker (Sail):**
```bash
./vendor/bin/sail artisan test
```

O con más detalle:
```bash
./vendor/bin/sail artisan test --coverage
```

**Sin Docker:**
```bash
php artisan test
```

O con más detalle:
```bash
php artisan test --coverage
```

## 📚 Endpoints Disponibles

### Productos

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/products` | Listar todos los productos |
| POST | `/api/products` | Crear un nuevo producto |
| GET | `/api/products/{id}` | Obtener un producto específico |
| PUT/PATCH | `/api/products/{id}` | Actualizar un producto |
| DELETE | `/api/products/{id}` | Eliminar un producto (soft delete) |

### Precios de Productos

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/products/{id}/prices` | Listar precios de un producto |
| POST | `/api/products/{id}/prices` | Crear precio en otra moneda |
| DELETE | `/api/products/{id}/prices/{price_id}` | Eliminar un precio |

## 📖 Documentación Detallada

Para más detalles sobre los endpoints, consulta:
- **[API_DOCUMENTATION.md](API_DOCUMENTATION.md)**: Documentación técnica completa
- **[postman_collection.json](postman_collection.json)**: Colección de Postman
- **[insomnia_collection.json](insomnia_collection.json)**: Colección de Insomnia

## 🔧 Comandos Útiles

```bash
# Limpiar caché
./vendor/bin/sail artisan cache:clear

# Refrescar base de datos con seeders
./vendor/bin/sail artisan migrate:fresh --seed

# Ver rutas disponibles
./vendor/bin/sail artisan route:list

# Ejecutar Pint (code style)
./vendor/bin/sail pint
```

## 📝 Datos de Ejemplo (Seeders)

Los seeders crean:
- **3 monedas**: USD, VES (Bolívar Venezolano), ARS (Peso Argentino)
- **3 productos de ejemplo**: Laptop, Mouse, Teclado
- **Precios alternativos** para cada producto en diferentes monedas

## 🔒 Seguridad

- Validación de datos con FormRequests
- Sanitización automática de inputs
- Rate limiting configurado
- Manejo de errores centralizado
- Sin autenticación (según requerimientos para facilitar pruebas)

## 📄 Licencia

MIT License
