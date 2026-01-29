# Documentación Técnica de la API

## 📋 Información General

**Base URL**: `http://localhost/api`

**Formato de respuesta**: JSON

**Autenticación**: No requerida

---

## 📦 Endpoints de Productos

### 1. Listar todos los productos

**Endpoint**: `GET /api/products`

**Descripción**: Obtiene una lista de todos los productos con sus relaciones (moneda base y precios alternativos).

**Request**:
```bash
curl -X GET http://localhost/api/products \
  -H "Accept: application/json"
```

**Response exitoso** (200 OK):
```json
{
  "data": [
    {
      "id": 1,
      "name": "Laptop Dell XPS 15",
      "description": "Laptop de alto rendimiento con procesador Intel i7",
      "price": "1299.99",
      "tax_cost": "129.99",
      "manufacturing_cost": "800.00",
      "created_at": "2026-01-29T12:00:00.000000Z",
      "updated_at": "2026-01-29T12:00:00.000000Z",
      "currency": {
        "id": 1,
        "name": "US Dollar",
        "symbol": "USD",
        "exchange_rate": "1.0000"
      },
      "prices": [
        {
          "id": 1,
          "product_id": 1,
          "price": "47449.64",
          "currency": {
            "id": 2,
            "name": "Venezuelan Bolívar",
            "symbol": "VES",
            "exchange_rate": "36.5000"
          }
        }
      ]
    }
  ]
}
```

---

### 2. Crear un nuevo producto

**Endpoint**: `POST /api/products`

**Descripción**: Crea un nuevo producto en el sistema.

**Request**:
```bash
curl -X POST http://localhost/api/products \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Mouse Logitech MX Master 3",
    "description": "Mouse ergonómico inalámbrico de alta precisión",
    "price": 99.99,
    "currency_id": 1,
    "tax_cost": 9.99,
    "manufacturing_cost": 45.00
  }'
```

**Parámetros requeridos**:

| Campo | Tipo | Descripción | Validación |
|-------|------|-------------|------------|
| `name` | string | Nombre del producto | Requerido, máx 255 caracteres |
| `description` | string | Descripción del producto | Requerido |
| `price` | decimal | Precio base | Requerido, numérico, mínimo 0 |
| `currency_id` | integer | ID de la moneda base | Requerido, debe existir en tabla currencies |
| `tax_cost` | decimal | Costo de impuestos | Requerido, numérico, mínimo 0 |
| `manufacturing_cost` | decimal | Costo de fabricación | Requerido, numérico, mínimo 0 |

**Response exitoso** (201 Created):
```json
{
  "data": {
    "id": 4,
    "name": "Mouse Logitech MX Master 3",
    "description": "Mouse ergonómico inalámbrico de alta precisión",
    "price": "99.99",
    "tax_cost": "9.99",
    "manufacturing_cost": "45.00",
    "created_at": "2026-01-29T14:30:00.000000Z",
    "updated_at": "2026-01-29T14:30:00.000000Z",
    "currency": {
      "id": 1,
      "name": "US Dollar",
      "symbol": "USD",
      "exchange_rate": "1.0000"
    },
    "prices": []
  }
}
```

**Response de error** (422 Unprocessable Entity):
```json
{
  "message": "The name field is required. (and 5 more errors)",
  "errors": {
    "name": ["The name field is required."],
    "description": ["The description field is required."],
    "price": ["The price field is required."],
    "currency_id": ["The currency id field is required."],
    "tax_cost": ["The tax cost field is required."],
    "manufacturing_cost": ["The manufacturing cost field is required."]
  }
}
```

---

### 3. Obtener un producto específico

**Endpoint**: `GET /api/products/{id}`

**Descripción**: Obtiene los detalles de un producto específico por su ID.

**Request**:
```bash
curl -X GET http://localhost/api/products/1 \
  -H "Accept: application/json"
```

**Response exitoso** (200 OK):
```json
{
  "data": {
    "id": 1,
    "name": "Laptop Dell XPS 15",
    "description": "Laptop de alto rendimiento con procesador Intel i7",
    "price": "1299.99",
    "tax_cost": "129.99",
    "manufacturing_cost": "800.00",
    "created_at": "2026-01-29T12:00:00.000000Z",
    "updated_at": "2026-01-29T12:00:00.000000Z",
    "currency": {
      "id": 1,
      "name": "US Dollar",
      "symbol": "USD",
      "exchange_rate": "1.0000"
    },
    "prices": [
      {
        "id": 1,
        "product_id": 1,
        "price": "47449.64",
        "currency": {
          "id": 2,
          "name": "Venezuelan Bolívar",
          "symbol": "VES",
          "exchange_rate": "36.5000"
        }
      }
    ]
  }
}
```

**Response de error** (404 Not Found):
```json
{
  "message": "No query results for model [App\\Models\\Product] 999"
}
```

---

### 4. Actualizar un producto

**Endpoint**: `PUT /api/products/{id}` o `PATCH /api/products/{id}`

**Descripción**: Actualiza los datos de un producto existente. Todos los campos son opcionales.

**Request**:
```bash
curl -X PUT http://localhost/api/products/1 \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Laptop Dell XPS 15 (2026)",
    "price": 1399.99
  }'
```

**Parámetros opcionales**:

| Campo | Tipo | Descripción | Validación |
|-------|------|-------------|------------|
| `name` | string | Nombre del producto | Opcional, máx 255 caracteres |
| `description` | string | Descripción del producto | Opcional |
| `price` | decimal | Precio base | Opcional, numérico, mínimo 0 |
| `currency_id` | integer | ID de la moneda base | Opcional, debe existir en tabla currencies |
| `tax_cost` | decimal | Costo de impuestos | Opcional, numérico, mínimo 0 |
| `manufacturing_cost` | decimal | Costo de fabricación | Opcional, numérico, mínimo 0 |

**Response exitoso** (200 OK):
```json
{
  "data": {
    "id": 1,
    "name": "Laptop Dell XPS 15 (2026)",
    "description": "Laptop de alto rendimiento con procesador Intel i7",
    "price": "1399.99",
    "tax_cost": "129.99",
    "manufacturing_cost": "800.00",
    "created_at": "2026-01-29T12:00:00.000000Z",
    "updated_at": "2026-01-29T14:35:00.000000Z",
    "currency": {
      "id": 1,
      "name": "US Dollar",
      "symbol": "USD",
      "exchange_rate": "1.0000"
    },
    "prices": [
      {
        "id": 1,
        "product_id": 1,
        "price": "47449.64",
        "currency": {
          "id": 2,
          "name": "Venezuelan Bolívar",
          "symbol": "VES",
          "exchange_rate": "36.5000"
        }
      }
    ]
  }
}
```

---

### 5. Eliminar un producto

**Endpoint**: `DELETE /api/products/{id}`

**Descripción**: Elimina un producto (soft delete). El producto no se borra físicamente de la base de datos.

**Request**:
```bash
curl -X DELETE http://localhost/api/products/1 \
  -H "Accept: application/json"
```

**Response exitoso** (200 OK):
```json
{
  "message": "Product deleted successfully"
}
```

**Response de error** (404 Not Found):
```json
{
  "message": "No query results for model [App\\Models\\Product] 999"
}
```

---

## 💰 Endpoints de Precios de Productos

### 6. Listar precios de un producto

**Endpoint**: `GET /api/products/{product_id}/prices`

**Descripción**: Obtiene todos los precios alternativos de un producto en diferentes monedas.

**Request**:
```bash
curl -X GET http://localhost/api/products/1/prices \
  -H "Accept: application/json"
```

**Response exitoso** (200 OK):
```json
{
  "data": [
    {
      "id": 1,
      "product_id": 1,
      "price": "47449.64",
      "currency": {
        "id": 2,
        "name": "Venezuelan Bolívar",
        "symbol": "VES",
        "exchange_rate": "36.5000"
      }
    },
    {
      "id": 2,
      "product_id": 1,
      "price": "1234495.05",
      "currency": {
        "id": 3,
        "name": "Argentine Peso",
        "symbol": "ARS",
        "exchange_rate": "950.0000"
      }
    }
  ]
}
```

---

### 7. Crear un precio alternativo

**Endpoint**: `POST /api/products/{product_id}/prices`

**Descripción**: Crea un nuevo precio para el producto en una moneda diferente.

**Request**:
```bash
curl -X POST http://localhost/api/products/1/prices \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "currency_id": 2,
    "price": 50000.00
  }'
```

**Parámetros requeridos**:

| Campo | Tipo | Descripción | Validación |
|-------|------|-------------|------------|
| `currency_id` | integer | ID de la moneda | Requerido, debe existir en tabla currencies |
| `price` | decimal | Precio en la moneda especificada | Requerido, numérico, mínimo 0 |

**Response exitoso** (201 Created):
```json
{
  "data": {
    "id": 5,
    "product_id": 1,
    "price": "50000.00",
    "currency": {
      "id": 2,
      "name": "Venezuelan Bolívar",
      "symbol": "VES",
      "exchange_rate": "36.5000"
    }
  }
}
```

**Response de error** (422 Unprocessable Entity):
```json
{
  "message": "The currency id field is required. (and 1 more error)",
  "errors": {
    "currency_id": ["The currency id field is required."],
    "price": ["The price field is required."]
  }
}
```

---

### 8. Eliminar un precio alternativo

**Endpoint**: `DELETE /api/products/{product_id}/prices/{price_id}`

**Descripción**: Elimina un precio alternativo de un producto.

**Request**:
```bash
curl -X DELETE http://localhost/api/products/1/prices/5 \
  -H "Accept: application/json"
```

**Response exitoso** (200 OK):
```json
{
  "message": "Product price deleted successfully"
}
```

**Response de error** (404 Not Found):
```json
{
  "message": "No query results for model [App\\Models\\ProductPrice] 999"
}
```

---

## 🔢 Códigos de Estado HTTP

| Código | Descripción |
|--------|-------------|
| 200 | OK - Solicitud exitosa |
| 201 | Created - Recurso creado exitosamente |
| 422 | Unprocessable Entity - Error de validación |
| 404 | Not Found - Recurso no encontrado |
| 500 | Internal Server Error - Error del servidor |

---

## 📝 Notas Importantes

1. **Soft Deletes**: Los productos eliminados no se borran físicamente, solo se marcan como eliminados (`deleted_at`).

2. **Eager Loading**: Todos los endpoints cargan automáticamente las relaciones necesarias para evitar el problema N+1.

3. **Validación**: Todos los campos numéricos aceptan decimales con hasta 2 posiciones.

4. **Moneda Base**: Cada producto tiene una moneda base (`currency_id`) que define su precio principal.

5. **Precios Alternativos**: Un producto puede tener múltiples precios en diferentes monedas a través de la tabla `product_prices`.

6. **Headers Requeridos**: 
   - `Accept: application/json` (recomendado)
   - `Content-Type: application/json` (para POST/PUT/PATCH)

---

## 🧪 Testing

Para probar los endpoints, puedes usar:
- **Postman**: Importa `postman_collection.json`
- **Insomnia**: Importa `insomnia_collection.json`
- **cURL**: Usa los ejemplos de esta documentación
- **PHPUnit**: Ejecuta `./vendor/bin/sail artisan test`
