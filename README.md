# Sistema Web Yunguena - Gestión de Viajes

Sistema web desarrollado en PHP y MySQL para la gestión de rutas, horarios, buses, pasajeros y reservas de la empresa de transporte Yunguena.

## Integrantes Grupo 6 

- "Equipo 6, PABLO SANTOS    MALDONADO GONZALES,"
- "Equipo 6,JHONN CRISTHIAN    MAYTA NINA,"
- "Equipo 6,LUIS FERNANDO    ARCAYA TICONA,"
- "Equipo 6,JUDITH NOEMI    UTURUNCO MAMANI,"
- "Equipo 6,LIZ MADISON    CHIRINOS CUSI,"

---

# Tecnologías Utilizadas

- PHP 8.2
- Apache
- MySQL
- Docker
- Fly.io
- Railway
- MySQL Workbench
- XAMPP

---

# Arquitectura

Usuario
↓
Fly.io
↓
Contenedor Docker
↓
Aplicación PHP
↓
Base de Datos MySQL (Railway)

---

# Requisitos

Para ejecutar el proyecto localmente se requiere:

- XAMPP
- PHP 8+
- MySQL
- Docker Desktop (opcional)
- Cuenta en Railway
- Cuenta en Fly.io

---

# Instalación Local

## 1. Clonar el repositorio

```bash
git clone https://github.com/USUARIO/yunguena-proyecto-sistemas.git
```

## 2. Copiar el proyecto

Mover la carpeta a:

```text
C:\xampp\htdocs\
```

## 3. Iniciar XAMPP

Activar:

- Apache
- MySQL

## 4. Crear la Base de Datos

Abrir phpMyAdmin:

```text
http://localhost/phpmyadmin
```

Crear:

```sql
CREATE DATABASE eldorado_db;
```

## 5. Importar la Base de Datos

Importar el archivo:

```text
eldorado_db.sql
```

## 6. Configurar la conexión

Editar:

```text
config/database.php
```

Ejemplo local:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'eldorado_db');
```

## 7. Ejecutar el sistema

Abrir:

```text
http://localhost/yunguena-proyecto-sistemas
```

---

# Configuración de Railway

## 1. Crear Proyecto

Ingresar a Railway y crear un nuevo proyecto.

## 2. Agregar MySQL

Seleccionar:

```text
New Service
→ Database
→ MySQL
```

## 3. Obtener Credenciales

Variables utilizadas:

```text
MYSQLHOST
MYSQLPORT
MYSQLDATABASE
MYSQLUSER
MYSQLPASSWORD
```

Ejemplo:

```text
Host: crossover.proxy.rlwy.net
Puerto: 18690
Base de datos: railway
Usuario: root
```

## 4. Importar Base de Datos

Desde MySQL Workbench:

```text
Administration
→ Data Import
→ Import from Self Contained File
```

Seleccionar:

```text
eldorado_db.sql
```

---

# Configuración para Producción

Editar:

```php
config/database.php
```

Configuración utilizada:

```php
define('DB_HOST', 'crossover.proxy.rlwy.net');
define('DB_PORT', '18690');
define('DB_USER', 'root');
define('DB_PASS', '********');
define('DB_NAME', 'railway');
```

DSN:

```php
mysql:host=HOST;port=PUERTO;dbname=DATABASE;charset=utf8mb4
```

---

# Docker

## Construir Imagen

```bash
docker build -t yunguena .
```

## Ejecutar Contenedor

```bash
docker run -p 8080:80 yunguena
```

## Verificar

```text
http://localhost:8080
```

---

# Despliegue en Fly.io

## 1. Instalar Fly CLI

```bash
fly auth login
```

## 2. Inicializar Proyecto

```bash
fly launch
```

Esto genera:

```text
fly.toml
```

## 3. Configurar Variables

```bash
fly secrets set DB_HOST=crossover.proxy.rlwy.net
```

```bash
fly secrets set DB_PORT=18690
```

```bash
fly secrets set DB_NAME=railway
```

```bash
fly secrets set DB_USER=root
```

```bash
fly secrets set DB_PASS=********
```

## 4. Desplegar

```bash
fly deploy
```

---

# URL del Proyecto

Aplicación desplegada:

```text
https://yunguena-proyecto-sistemas.fly.dev
```

---

# Problemas Encontrados

## Error de conexión

Error:

```text
SQLSTATE[HY000] [2002]
```

Solución:

- Configurar correctamente host y puerto de Railway.

---

## Error Network is unreachable

Solución:

- Agregar puerto Railway en el DSN.

```php
port=18690
```

---

## Error Table already exists

Solución:

- Verificar tablas existentes antes de volver a importar el SQL.

---

# Verificación

Prueba de conexión:

```php
<?php

require 'config/database.php';

try {
    Database::connect();
    echo "CONEXIÓN EXITOSA";
} catch(Exception $e){
    echo $e->getMessage();
}
```

---

# Evidencia de Funcionamiento

- Sistema funcionando localmente con XAMPP.
<img width="1918" height="970" alt="image" src="https://github.com/user-attachments/assets/bedd56bf-de6c-42bc-9564-e5eefdd30c07" />


- Base de datos alojada en Railway.
<img width="1918" height="912" alt="image" src="https://github.com/user-attachments/assets/7c6ce381-cd43-4633-8a00-d11d277fc982" />


- Aplicación desplegada en Fly.io.
- EN EL CMD
<img width="1600" height="820" alt="image" src="https://github.com/user-attachments/assets/31ab18e8-2782-4e40-94c7-c22c340bbbd3" />

  
- EN LA PAGIN WEB DE FLY.IO
<img width="1900" height="910" alt="image" src="https://github.com/user-attachments/assets/3d075b99-7830-46c7-9792-ae40b79f95ca" />


- Administración remota mediante MySQL Workbench.
- Visualización de Tablas
<img width="1918" height="1018" alt="image" src="https://github.com/user-attachments/assets/96fe6f9e-edd8-4c4c-8a67-75c9ed1d2c1f" />
- Administración
<img width="1917" height="1018" alt="image" src="https://github.com/user-attachments/assets/f8c5dacd-bfda-4917-b614-e1d9c3f635cf" />


---

