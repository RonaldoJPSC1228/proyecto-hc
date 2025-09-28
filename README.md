<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

## 🚀 Inicialización Local (Laravel + FastAPI)

### Prerrequisitos

- PHP 8+
- Composer
- Node.js y npm (para Tailwind CSS)
- Python 3.13 (para FastAPI)
- Base de datos local (MySQL/MariaDB/SQLite)
- Repositorios clonados: este proyecto (Laravel) y [api_diagnostico](https://github.com/RonaldoJPSC1228/api_diagnostico_py)

---

### Instala las dependencias de Laravel

1. Instala dependencias PHP:
    ```
    composer install
    ```
    > Para actualizar composer:
    ```
    composer update
    ```
2. Crea el archivo de entorno:
    ```
    cp .env.example .env
    ```
3. Recarga los archivos autoload de Laravel:
    ```
    composer dump-autoload
    ```
4. Genera la clave de la aplicación:
    ```
    php artisan key:generate
    ```
5. Realiza migraciones a la base de datos:
    ```
    php artisan migrate
    ```
6. Monta los datos con seeders:
    ```
    php artisan db:seed
    ```
7. Ejecuta el servidor local del proyecto:
    ```
    php artisan serve
    ```

---

### Inicializa la API FastAPI

Ingresa al directorio del proyecto `api_diagnostico`:(https://github.com/RonaldoJPSC1228/api_diagnostico_py)


---

### Flujo general

- Laravel disponible en: `http://127.0.0.1:8000`
- FastAPI disponible en: `http://127.0.0.1:8001`
- El frontend Laravel envía los datos a `/diagnostico` y muestra el resultado en el formulario.

---

**¡Listo para desarrollar y probar la app localmente!**


