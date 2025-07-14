# Tienda online PlantFix - Backend (API RESTful)

Este repositorio contiene el backend de PlantFix, una tienda online de plantas. Se trata de una API RESTful desarrollada con Laravel, que permite gestionar productos, pedidos y usuarios mediante peticiones HTTP y respuestas en formato JSON. Utiliza Laravel Sanctum para la autenticación basada en tokens y Laravel Breeze como sistema de autenticación ligera y sencilla.

## Tabla de contenidos
* [Requisitos](#requisitos)
* [Instalación](#instalación)
* [Configuración del entorno](#configuración-del-entorno)
* [API RESTful](#api-restful)
* [Seeders](#seeders)
* [Colaboradores](#colaboradores-del-proyecto)

### Primeros pasos

#### Requisitos:
* <a href="https://www.php.net/downloads.php">PHP</a>
* <a href="https://getcomposer.org/doc/00-intro.md#using-the-installer">Composer</a>
* <a href="https://docs.npmjs.com/downloading-and-installing-node-js-and-npm">NPM</a>
* Un sistema de base de datos (SQLite recomendado para desarrollo)

#### Instalación:
Una vez que tengamos el proyecto clonado abriremos una consola en la carpeta "PlantfixBackend" y ejecutaremos los siguientes comandos:

```
composer install
```
 Necesario para instalar todas las dependencias requeridas por el proyecto.

 ```
 cp .env.example .env
 ```
Este es el archivo de variables de entorno, en el podremos configurar datos importantes de la aplicación, como la base de datos que utilizara, por defecto SQLite.

```
php artisan key:generate
```
 Genera una clave de aplicación única. Laravel utiliza la clave de aplicación (APP_KEY en el archivo .env) para cifrar y descifrar datos sensibles, como sesiones de usuario, tokens y otros elementos que requieren seguridad.

```
php artisan migrate
```
Este comando genera las tablas necesarias para almacenar las sesiones en la base de datos. Si utilizamos SQLite y es la primera vez que lo hacemos nos preguntara si queremos crear el archivo de la base de datos.

```
php artisan db:seed
```
Este comando introduce datos en las tablas, excepto en pedidos. También se pueden combinar:

php artisan migrate --seed

```
npm install
```
Para instalar las dependencias necesarias.

```
npm run build
```

Para compilar los recursos.

Con esto abremos creado lo necesario para utilizar la aplicación, si queremos arrancar el servidor que incluye laravel ejecutaremos el siguiente comando:

```
php artisan serve
```

Esto generara un servidor web en local para poder acceder a la aplicación.
La API estará disponible en http://localhost:8000.

### Configuración del entorno
Edita el archivo .env para establecer correctamente los valores relacionados con Sanctum y el frontend (Angular):plo:
```
APP_URL=http://localhost:8000
FRONTEND_URL=http://localhost:4200

SESSION_DOMAIN=localhost
# SESSION_SECURE_COOKIE=false
SANCTUM_STATEFUL_DOMAINS=localhost:4200
# SESSION_STORE=localhost
```
Notas adicionales:

Si instalas el proyecto en un equipo nuevo y los paquetes no estuvieran definidos, puedes instalar Sanctum y Breeze con los siguientes comandos:

composer require laravel/sanctum

php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

composer require laravel/breeze --dev

php artisan breeze:install

##### API RESTful

Esta API sigue los principios RESTful y devuelve los datos en formato JSON. Permite realizar operaciones CRUD sobre recursos como:

Plantas (/api/plants)
Familias de plantas (/api/plant-families)
Pedidos (/api/orders)
Usuarios (/api/users)

Ejemplo de respuesta JSON:

{
  "data": [
    {
      "id": 1,
      "name": "Aloe Vera",
      "description": "Planta medicinal.",
      "price": 9.99,
      "stock": 20,
      "image_url": null,
      "created_at": "2025-02-03T12:53:23.000000Z",
      "updated_at": "2025-02-03T12:53:23.000000Z"
    }
  ]
}

##### Seeders

Para cargar datos iniciales de ejemplo (plantas, pedidos, etc.), puedes ejecutar:

php artisan db:seed

Puedes consultar o modificar los seeders en el directorio database/seeders.

Al ejecutar los seeders se crean dos usuarios con sus respectivos roles: 

- Un admin: 

correo: admin@gmail.com
contraseña: 12341234

-Un usuario normal:

correo: user@gmail.com
contraseña: 12341234

##### Colaboradores del proyecto
- Inacora Teresa Campos Alonso
