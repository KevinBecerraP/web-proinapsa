# Instituto Proinapsa - CMS

Sistema de gestión de contenido (CMS) para el sitio web del Instituto Proinapsa, construido con Laravel y Filament.

---

## Stack tecnológico

| Capa | Tecnología |
|---|---|
| Backend | Laravel 10 (PHP 8.1+) |
| Panel de administración | Filament 3 |
| Base de datos | MySQL |
| Autenticación | Laravel Sanctum |
| Permisos | Spatie Roles & Permissions |
| Assets | Vite |

---

## Requisitos

- PHP >= 8.1
- Composer
- Node.js >= 18
- MySQL

---

## Instalación

```bash
# 1. Clonar el repositorio
git clone <url-del-repo>
cd institutoproinapsa-cms

# 2. Instalar dependencias PHP
composer install

# 3. Instalar dependencias JS
npm install

# 4. Configurar el entorno
cp .env.example .env
php artisan key:generate

# 5. Configurar la base de datos en .env y migrar
php artisan migrate --seed

# 6. Compilar assets
npm run build

# 7. Levantar el servidor
php artisan serve
```

---

## Acceso al panel de administración

La URL del panel es `/admin`. Para crear el primer usuario administrador:

```bash
php artisan make:filament-user
```

---

## Módulos principales

- **Empresa** — Información institucional, valores, misión/visión
- **Educación formal** — Secciones educativas, cursos y materiales
- **Promoción de salud** — Categorías e ítems de salud
- **Grupos de investigación** — Gestión de grupos y publicaciones
- **Repositorio** — Categorías y documentos
- **Equipos** — Integrantes y áreas organizacionales
- **Banners / Tarjetas** — Contenido dinámico de la página de inicio
- **Usuarios y roles** — Control de acceso basado en roles

---

## Estructura relevante

```
app/Filament/Resources/   → Recursos del panel admin
app/Models/               → Modelos Eloquent
database/migrations/      → Migraciones de la BD
resources/views/          → Vistas Blade
```

---

## Licencia

Uso interno — Instituto Proinapsa.
