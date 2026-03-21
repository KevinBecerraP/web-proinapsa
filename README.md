# Instituto Proinapsa — CMS

![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?style=flat&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-3.x-F59E0B?style=flat&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=flat&logo=mysql&logoColor=white)
![Licencia](https://img.shields.io/badge/Licencia-Uso_Interno-6B7280?style=flat)

Sistema de gestión de contenido **(CMS)** para el sitio web institucional del **Instituto Proinapsa**. Desarrollado con **Laravel 10** y el panel administrativo **Filament 3**, centraliza la gestión de todo el contenido del sitio desde un único panel: páginas institucionales, noticias, cursos, publicaciones, repositorio de documentos, banners, testimonios, materiales educativos y más.

---

## Tabla de contenido

1. [Stack tecnológico](#stack-tecnológico)
2. [Módulos del CMS](#módulos-del-cms)
3. [Requisitos previos](#requisitos-previos)
4. [Instalación](#instalación)
5. [Estructura de directorios](#estructura-de-directorios)
6. [Arquitectura del panel (Filament)](#arquitectura-del-panel-filament)
7. [Patrones de diseño](#patrones-de-diseño)
8. [Base de datos](#base-de-datos)
9. [Almacenamiento de archivos](#almacenamiento-de-archivos)
10. [Grupos de navegación del panel](#grupos-de-navegación-del-panel)
11. [Sistema de roles y permisos](#sistema-de-roles-y-permisos)
12. [Seeders](#seeders)
13. [Migraciones](#migraciones)
14. [Comandos útiles](#comandos-útiles)
15. [Referencia rápida por módulo](#referencia-rápida-por-módulo)
16. [Historial de cambios](#historial-de-cambios)

---

## Stack tecnológico

| Capa | Tecnología | Versión | Descripción |
|:---|:---|:---:|:---|
| Backend | [Laravel](https://laravel.com) | ^10.10 | Framework PHP principal |
| Lenguaje | PHP | ^8.1 | Requisito mínimo del servidor |
| Panel admin | [Filament](https://filamentphp.com) | ~3.3 | Panel de administración visual |
| Base de datos | MySQL | ≥ 8.0 | Motor de base de datos relacional |
| Autenticación API | Laravel Sanctum | ^3.3 | Tokens para integración con el frontend |
| Roles y permisos | Spatie Roles & Permissions | ^2.3 | Control de acceso granular con integración Filament |
| Procesamiento de imágenes | [Intervention Image](https://image.intervention.io) | ^3.11 | Redimensionado y recorte automático de imágenes al subir |
| Assets | Vite + Tailwind CSS | — | Compilación y estilos del panel |

---

## Módulos del CMS

El sistema cuenta con **20 módulos** de gestión de contenido distribuidos en grupos temáticos.

| Módulo | Tabla BD | Límite | Ordenable | Soft Delete | Auditoría | Visible en panel |
|:---|:---|:---:|:---:|:---:|:---:|:---:|
| **Empresa** | `companies` | 1 (singleton) | — | — | — | Sí |
| **Usuarios** | `users` | Ilimitado | — | — | — | Sí |
| **Equipo** | `teams` | Ilimitado | — | — | — | Sí |
| **Áreas** | `areas` | Máx. 3 | Sí | — | Sí | Sí |
| **Valores Corporativos** | `values` | Ilimitado | Sí | — | — | Sí |
| **Testimonios** | `testimonials` | Ilimitado | Sí | — | Sí | Sí |
| **Noticias** | `news` | Ilimitado | Sí | — | Sí | Sí |
| **Banners** | `banners` | Ilimitado | Sí (solo `main`) | — | — | Sí |
| **Tarjetas Home** | `home_cards` | Máx. 6 | Sí | — | — | Sí |
| **Educación Formal** | `formal_education_sections` | Máx. 6 (uno por tipo) | Sí | — | Sí | Sí |
| **Cursos** | `courses` | Ilimitado | Sí | Sí | Sí | Sí |
| **Materiales Educativos** | `educational_materials` | Ilimitado | Sí | Sí | Sí | Sí |
| **Grupos de Materiales** | `educational_material_groups` | 4 (fijos) | Sí | — | Sí | **No** (oculto) |
| **Publicaciones** | `publications` | Ilimitado | Sí | Sí | Sí | Sí |
| **Grupo de Investigación** | `research_group` | 1 (singleton) | — | — | Sí | Sí |
| **Categorías de Salud** | `health_promotion_categories` | Máx. 4 | Sí | — | Sí | Sí |
| **Ítems de Salud** | `health_promotion_items` | Ilimitado | Sí | Sí | Sí | Sí |
| **Categorías de Repositorio** | `repository_categories` | Ilimitado | Sí | — | — | Sí |
| **Documentos de Repositorio** | `repository_documents` | Ilimitado | Sí | — | — | Sí |
| **Recursos Institucionales** | `institutional_resources` | Ilimitado | Sí | Sí | Sí | Sí |

> **Grupos de Materiales** está oculto del menú lateral (`shouldRegisterNavigation = false`) porque sus categorías son fijas y no deben ser modificadas por el administrador. El contenido de cada categoría se gestiona desde **Materiales Educativos**.

---

## Requisitos previos

| Requisito | Versión mínima | Notas |
|:---|:---:|:---|
| PHP | 8.1 | Extensiones requeridas: `mbstring`, `xml`, `curl`, `pdo_mysql`, `gd` o `imagick` |
| Composer | 2.x | Gestión de dependencias PHP |
| Node.js | 18 | Compilación de assets con Vite |
| MySQL | 8.0 | Motor de base de datos relacional |

> **Importante:** La extensión `gd` o `imagick` de PHP es **obligatoria** para que `intervention/image` pueda redimensionar imágenes automáticamente al subirlas. Sin esta extensión, cualquier campo de carga de imágenes con redimensionado lanzará un error `UnableToRetrieveMetadata`.

---

## Instalación

```bash
# 1. Clonar el repositorio
git clone <url-del-repo>
cd institutoproinapsa-cms

# 2. Instalar dependencias PHP (incluye intervention/image)
composer install

# 3. Instalar dependencias JS
npm install

# 4. Configurar el entorno
cp .env.example .env
php artisan key:generate

# 5. Configurar la base de datos en .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=institutoproinapsa
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Ejecutar migraciones y seeders
php artisan migrate --seed

# 7. Crear enlace simbólico para almacenamiento público
php artisan storage:link

# 8. Compilar assets del panel
npm run build

# 9. Crear el primer usuario administrador
php artisan make:filament-user

# 10. Levantar el servidor de desarrollo
php artisan serve
```

> El panel de administración queda disponible en **`http://localhost:8000/admin`**.

---

## Estructura de directorios

```
institutoproinapsa-cms/
│
├── app/
│   ├── Filament/
│   │   └── Resources/                     ← Un Resource por módulo
│   │       ├── AreaResource.php
│   │       ├── BannerResource.php
│   │       ├── CompanyResource.php
│   │       ├── CourseResource.php
│   │       ├── EducationalMaterialResource.php
│   │       ├── EducationalMaterialGroupResource.php   ← Oculto del menú
│   │       ├── FormalEducationSectionResource.php
│   │       ├── HealthPromotionCategoryResource.php
│   │       ├── HealthPromotionItemResource.php
│   │       ├── HomeCardResource.php
│   │       ├── InstitutionalResource.php
│   │       ├── NewsResource.php
│   │       ├── PublicationResource.php
│   │       ├── RepositoryCategoryResource.php
│   │       ├── RepositoryDocumentResource.php
│   │       ├── ResearchGroupResource.php
│   │       ├── TeamResource.php
│   │       ├── TestimonialResource.php
│   │       ├── UserResource.php
│   │       └── ValuesResource.php
│   │
│   │       [Cada Resource tiene su carpeta de Pages/]
│   │       └── NombreResource/
│   │           └── Pages/
│   │               ├── ListXxx.php         ← Vista de tabla con listado
│   │               ├── CreateXxx.php       ← Formulario de creación
│   │               └── EditXxx.php         ← Formulario de edición
│   │
│   └── Models/                            ← Modelos Eloquent
│       ├── Area.php
│       ├── Banner.php
│       ├── Company.php
│       ├── Course.php
│       ├── EducationalMaterial.php
│       ├── EducationalMaterialGroup.php
│       ├── FormalEducationSection.php
│       ├── HealthPromotionCategory.php
│       ├── HealthPromotionItem.php
│       ├── HomeCard.php
│       ├── Institutional.php
│       ├── News.php
│       ├── Publication.php
│       ├── RepositoryCategory.php
│       ├── RepositoryDocument.php
│       ├── ResearchGroup.php
│       ├── Team.php
│       ├── Testimonial.php
│       ├── User.php
│       └── Values.php
│
├── database/
│   ├── migrations/                        ← Una migración por tabla/alteración
│   └── seeders/                           ← Datos base del sistema
│       ├── DatabaseSeeder.php             ← Orquestador principal
│       ├── AreaSeeder.php                 ← 3 áreas fijas
│       ├── HealthPromotionCategorySeeder.php  ← 4 categorías de salud
│       ├── EducationalMaterialGroupSeeder.php ← 4 grupos de materiales
│       └── [otros seeders de prueba]
│
└── storage/app/public/                    ← Archivos subidos (symlink público)
    ├── areas/
    │   ├── images/                        ← Imagen principal del área
    │   └── education/                     ← Imágenes sub-secciones educación
    ├── banners/                           ← Imágenes de banners
    ├── company/                           ← Logo, favicon, documentos
    ├── courses/                           ← Imágenes y PDFs de cursos
    ├── educational-materials/
    │   ├── images/                        ← Imágenes de materiales
    │   └── pdfs/                          ← PDFs de materiales
    ├── formal-education/                  ← Íconos y PDFs de educación formal
    ├── health-promotion/                  ← Imágenes de categorías de salud
    ├── news/                              ← Imágenes de noticias
    ├── publications/                      ← Portadas de publicaciones
    ├── repository/                        ← Documentos del repositorio
    └── team/                              ← Fotografías del equipo
```

---

## Arquitectura del panel (Filament)

Cada módulo del CMS se compone de **3 capas** que trabajan juntas:

```
┌─────────────────────────────────────────────────────┐
│                  PETICIÓN HTTP                      │
└────────────────────────┬────────────────────────────┘
                         │
                         ▼
┌─────────────────────────────────────────────────────┐
│                 FILAMENT RESOURCE                   │
│  NombreResource.php                                 │
│  ┌──────────────┐ ┌──────────────┐ ┌─────────────┐ │
│  │   form()     │ │   table()    │ │ getPages()  │ │
│  │ Define todos │ │ Define lista │ │ Registra    │ │
│  │ los campos   │ │ columnas y   │ │ las rutas   │ │
│  │ del form.    │ │ filtros      │ │ disponibles │ │
│  └──────────────┘ └──────────────┘ └─────────────┘ │
└────────────────────────┬────────────────────────────┘
                         │
              ┌──────────┴──────────┐
              ▼                     ▼
┌─────────────────────┐  ┌──────────────────────────┐
│   MODEL (Eloquent)  │  │     PAGES (Livewire)      │
│   Nombre.php        │  │  ListXxx / CreateXxx /    │
│  - $fillable        │  │  EditXxx                  │
│  - relationships    │  │  - Controlan la vista      │
│  - boot() hooks     │  │  - Customización por página│
│  - scopes           │  └──────────────────────────┘
└─────────────────────┘
```

### Rutas generadas automáticamente por módulo

| Página | Clase | Ruta en el panel |
|:---|:---|:---|
| Listado | `ListXxx.php` | `/admin/nombre` |
| Crear | `CreateXxx.php` | `/admin/nombre/create` |
| Editar | `EditXxx.php` | `/admin/nombre/{id}/edit` |

---

## Patrones de diseño

### 1. Auto-orden al crear y reorganización al eliminar

Todos los módulos con campo `order` asignan el número automáticamente al crear un registro y reorganizan los demás al eliminar, eliminando huecos en la secuencia.

```php
// En boot() del modelo
static::creating(function ($model) {
    if (empty($model->order)) {
        $model->order = (static::max('order') ?? 0) + 1;
    }
});

static::deleted(function ($model) {
    static::where('order', '>', $model->order)->decrement('order');
});
```

### 2. Auditoría automática (created_by / updated_by)

Los módulos con auditoría registran el usuario que creó o modificó cada registro.

```php
static::creating(fn($m) => $m->created_by = auth()->id());
static::updating(fn($m) => $m->updated_by = auth()->id());
```

### 3. Listado siempre de más reciente a más antiguo

Todos los módulos del panel muestran los registros ordenados por `created_at DESC` como comportamiento por defecto. Esto es independiente del campo `order` (que controla la visualización en el sitio web).

```php
->defaultSort('created_at', 'desc')
```

### 4. Reordenamiento drag & drop

Los módulos que permiten definir el orden de aparición en el sitio web tienen habilitado el arrastre de filas directamente en la tabla del panel.

```php
->reorderable('order')

// En el modelo:
public function scopeOrdered($query) {
    return $query->orderBy('order', 'asc');
}

// En el Resource:
public static function getEloquentQuery(): Builder {
    return parent::getEloquentQuery()->ordered();
}
```

### 5. Catálogo completo de patrones aplicados

| Patrón | Descripción | Aplica a |
|:---|:---|:---|
| **Singleton** | Solo puede existir un registro. `canCreate()` retorna `false` si ya hay uno | `ResearchGroup`, `Company` |
| **Límite máximo** | `canCreate()` retorna `false` al alcanzar el tope configurado | `HomeCard` (6), `Area` (3), `HealthPromotionCategory` (4), `FormalEducationSection` (6) |
| **Módulo oculto** | `shouldRegisterNavigation()` retorna `false` — existe en BD pero no aparece en el menú | `EducationalMaterialGroup` |
| **Campos de solo lectura** | `->disabled()->dehydrated()` — visibles pero no editables; el valor sí se guarda | `Area` (nombre, slug fijos para que el frontend funcione) |
| **Campos condicionales** | Se muestran u ocultan según el valor de otro campo (`->live()` + `->visible()`) | `Banner` (subtítulo por tipo), `HomeCard` (PDF vs URL), `Area` (sub-secciones solo para educación) |
| **Visibilidad por registro** | La sección completa se oculta o muestra según el slug del registro en edición | `Area` → sección "Educación y Comunicación" solo visible si `slug = educacion-comunicacion` |
| **Soft Deletes** | Registros marcados con `deleted_at` en vez de borrarse físicamente | `Course`, `Institutional`, `Publication`, `HealthPromotionItem` |
| **Limpieza de archivos** | Elimina del storage archivos antiguos al actualizar o eliminar un registro | `Company`, `News`, `Team`, `Banner` |
| **Slugs automáticos** | El slug se genera automáticamente a partir del título con `Str::slug()` | `News`, `RepositoryCategory` |
| **Accessor calculado** | Valor calculado sin columna en BD | `ResearchGroup::getTotalPublicationsAttribute()` |
| **Restricción única por tipo** | Solo puede existir un registro por cada valor del ENUM | `FormalEducationSection` (una por `section`) |

---

## Base de datos

### Diagrama de relaciones

```
users
 ├── areas                          (created_by → users.id, updated_by → users.id)
 ├── testimonials                   (created_by, updated_by)
 ├── news                           (created_by, updated_by)
 ├── formal_education_sections      (created_by, updated_by)
 ├── courses                        (created_by, updated_by)
 ├── educational_materials          (created_by, updated_by)
 ├── publications                   (created_by, updated_by)
 ├── research_group                 (created_by, updated_by)
 ├── health_promotion_categories    (created_by, updated_by)
 ├── health_promotion_items         (created_by, updated_by)
 └── institutional_resources        (created_by, updated_by)

areas
 ├── teams                          (coordinator_id → teams.id) [coordinador del área]
 ├── formal_education_sections      (area_id → areas.id)
 ├── courses                        (area_id → areas.id)
 ├── educational_materials          (area_id → areas.id)
 ├── publications                   (area_id → areas.id)
 ├── research_group                 (area_id → areas.id)
 └── health_promotion_categories    (area_id → areas.id)

health_promotion_categories
 └── health_promotion_items         (category_id → health_promotion_categories.id)

repository_categories
 └── repository_documents           (repository_category_id → repository_categories.id)
```

### Resumen de tablas y su propósito

| # | Tabla | Propósito | Límite |
|:---:|:---|:---|:---:|
| 1 | `users` | Usuarios del panel administrativo | Ilimitado |
| 2 | `companies` | Información institucional del Instituto | 1 (singleton) |
| 3 | `teams` | Integrantes del equipo de trabajo | Ilimitado |
| 4 | `areas` | Áreas organizacionales del Instituto | Máx. 3 |
| 5 | `values` | Valores corporativos | Ilimitado |
| 6 | `testimonials` | Testimonios de usuarios del sitio | Ilimitado |
| 7 | `news` | Noticias publicadas | Ilimitado |
| 8 | `banners` | Banners principales e internos | Ilimitado |
| 9 | `home_cards` | Tarjetas de la página de inicio | Máx. 6 |
| 10 | `formal_education_sections` | Secciones de Educación Formal | Máx. 6 (1 por tipo) |
| 11 | `courses` | Cursos disponibles | Ilimitado |
| 12 | `educational_materials` | Materiales educativos (guías, juegos) | Ilimitado |
| 13 | `educational_material_groups` | Categorías de materiales (fijas, no editables) | 4 (fijos) |
| 14 | `publications` | Publicaciones académicas | Ilimitado |
| 15 | `research_group` | Grupo de investigación del Instituto | 1 (singleton) |
| 16 | `research_lines` | Líneas de investigación del grupo | Ilimitado |
| 17 | `health_promotion_categories` | Categorías de promoción de salud | Máx. 4 |
| 18 | `health_promotion_items` | Ítems de contenido de salud | Ilimitado |
| 19 | `repository_categories` | Categorías del repositorio documental | Ilimitado |
| 20 | `repository_documents` | Documentos del repositorio | Ilimitado |
| 21 | `institutional_resources` | Links de interés y socios aliados | Ilimitado |

---

### Detalle de campos por tabla

<details>
<summary><strong>companies — Información institucional (Singleton)</strong></summary>

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `business_name` | `string` | Razón social de la institución |
| `slogan` | `string` | Eslogan institucional |
| `description` | `text` | Descripción general |
| `address` | `string` | Dirección física |
| `phone_1` … `phone_5` | `string` (nullable) | Teléfonos de contacto (hasta 5) |
| `email_1` … `email_3` | `string` (nullable) | Correos de contacto (hasta 3) |
| `facebook_link` … `threads_link` | `string` (nullable) | Redes sociales |
| `logo` | `string` | Logo principal (725×121 px) |
| `favicon` | `string` | Ícono del navegador (132×128 px) |
| `video_link` | `string` | Link de video institucional |
| `privacy_policy_pdf` | `string` | PDF de política de protección de datos |
| `mission_title` / `mission_description` | `string` / `text` | Sección Misión |
| `mission_image_1/2/3` | `string` | Imágenes de la Misión |
| `vision_title` / `vision_description` / `vision_image` | — | Sección Visión (imagen 960×523 px) |
| `trajectory_title` / `trajectory_description` / `trajectory_image` | — | Trayectoria e historia (máx. 500 chars) |
| `methodology_title` / `methodology_description` / `methodology_image` | — | Metodología (RichEditor) |
| `latitude` / `longitude` | `decimal` | Coordenadas para Google Maps |

</details>

<details>
<summary><strong>teams — Equipo de trabajo</strong></summary>

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `name` | `string(100)` | Nombre completo del integrante |
| `position` | `string(100)` | Cargo dentro del Instituto |
| `profesion` | `string(100)` | Profesión |
| `description` | `text` | Descripción profesional (máx. **1000 chars**) |
| `image` | `string` | Fotografía (393×390 px, JPG/PNG) |
| `status` | `boolean` | Activo / Inactivo |

> La columna `description` **no aparece en el listado de la tabla** del panel para mantener la vista compacta. Solo es visible dentro del formulario de edición.

</details>

<details>
<summary><strong>areas — Áreas organizacionales (máx. 3)</strong></summary>

Los módulos de contenido (cursos, publicaciones, materiales educativos, etc.) siempre pertenecen a un área. Cada área tiene un coordinador asignado del equipo.

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `name` | `string(100)` | Nombre del área — **solo lectura** en el panel |
| `slug` | `string(100)` | Identificador URL — **solo lectura** en el panel |
| `description` | `text` | Descripción con formato (RichEditor) |
| `icon` | `string(100)` | Heroicon name (ej: `heroicon-o-academic-cap`) |
| `image` | `string` | Imagen principal del área (393×390 px, JPG/PNG, máx. 2 MB) |
| `coordinator_id` | `FK → teams.id` | Coordinador del área (obligatorio) |
| `order` | `integer` | Orden de aparición en el sitio web |
| `active` | `boolean` | Estado del área |
| `created_by` / `updated_by` | `FK → users.id` | Auditoría |

**Campos adicionales — exclusivos para el área `educacion-comunicacion`:**

Estos campos **solo aparecen en el formulario** cuando el área tiene el slug `educacion-comunicacion`. Gestionan el contenido de las tres sub-secciones de esa área.

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `formal_education_image` | `string` | Imagen — Educación Formal (1024×577 px, JPG/PNG, máx. 2 MB) |
| `formal_education_color` | `string(20)` | Color de fondo de tarjeta — Educación Formal (hex) |
| `formal_education_description` | `text` | Texto introductorio — Educación Formal (máx. 1000 chars) |
| `non_formal_education_image` | `string` | Imagen — Educación No Formal (1024×577 px, JPG/PNG, máx. 2 MB) |
| `non_formal_education_color` | `string(20)` | Color de fondo de tarjeta — Educación No Formal |
| `non_formal_education_description` | `text` | Texto introductorio — Educación No Formal (máx. 1000 chars) |
| `educational_materials_image` | `string` | Imagen — Materiales Educativos (1024×577 px, JPG/PNG, máx. 2 MB) |
| `educational_materials_color` | `string(20)` | Color de fondo de tarjeta — Materiales Educativos |
| `educational_materials_description` | `text` | Texto introductorio — Materiales Educativos (máx. 1000 chars) |

**Áreas sembradas con seeder (no eliminar ni renombrar):**

| # | Nombre | Slug | Módulos que contiene |
|:---:|:---|:---|:---|
| 1 | Educación y Comunicación | `educacion-comunicacion` | Educación Formal, Cursos, Materiales Educativos |
| 2 | Investigación | `investigacion` | Publicaciones, Grupo de Investigación |
| 3 | Proyección Social | `proyeccion-social` | Categorías de Salud, Ítems de Salud |

> **Importante:** Los campos `name` y `slug` están marcados como **solo lectura** (`->disabled()->dehydrated()`) porque el frontend los usa para enrutar a las páginas de cada área. Cambiarlos rompería la navegación del sitio web.

</details>

<details>
<summary><strong>values — Valores corporativos</strong></summary>

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `title` | `string(100)` | Nombre del valor (ej: Integridad) |
| `description` | `string(500)` | Descripción del valor |
| `order` | `integer` | Orden de aparición |
| `status` | `boolean` | Activo / Inactivo |

</details>

<details>
<summary><strong>testimonials — Testimonios</strong></summary>

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `name` | `string` | Nombre de la persona |
| `profile` | `string` | Perfil libre (ej: Estudiante, Docente) |
| `testimonial` | `string(600)` | Texto del testimonio |
| `rating` | `integer(1-5)` | Calificación de 1 a 5 estrellas |
| `order` | `integer` | Orden de aparición |
| `active` | `boolean` | Activo / Inactivo |
| `created_by` / `updated_by` | `FK → users.id` | Auditoría |

</details>

<details>
<summary><strong>news — Noticias</strong></summary>

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `title` | `string(150)` | Título de la noticia |
| `slug` | `string` | URL amigable (generado automáticamente) |
| `excerpt` | `string(300)` | Resumen para el listado |
| `content` | `longText` | Contenido completo con formato (RichEditor) |
| `image` | `string` | Imagen principal (relación 16:9) |
| `order` | `integer` | Orden de aparición |
| `active` | `boolean` | Activo / Inactivo |
| `created_by` / `updated_by` | `FK → users.id` | Auditoría |

</details>

<details>
<summary><strong>banners — Banners del sitio (2 tipos)</strong></summary>

Existen dos tipos de banner con comportamientos distintos:

- **Principal** (`main`): aparece en la página de inicio. Dimensiones exactas: **1920×960 px**. Tiene orden en carrusel y subtítulo.
- **Secundario** (`secondary`): aparece en páginas internas. Dimensiones exactas: **1920×500 px**. Solo uno por página. **Sin subtítulo ni orden de carrusel.**

**Comportamiento condicional del formulario:**

| Campo | Banner `main` | Banner `secondary` |
|:---|:---:|:---:|
| `title` / `title_color` | ✅ Requerido | ✅ Requerido |
| `subtitle` | ✅ Opcional (máx. 60 chars, contador en vivo) | ❌ Oculto |
| `subtitle_color` | ✅ Requerido | ❌ Oculto |
| `order` | ✅ Requerido | ❌ Oculto |
| `page` | ❌ Oculto | ✅ Requerido (única por página) |
| `button_link` / `button_color` | ✅ Opcional | ✅ Opcional |

**Páginas disponibles para banners secundarios:**

| Valor | Página |
|:---|:---|
| `about_us` | Quiénes Somos |
| `what_we_do` | Qué Hacemos |
| `research` | Investigación |
| `news` | Noticias |
| `educacion_comunicacion` | Educación y Comunicación |
| `proyeccion_social` | Proyección Social |
| `repository` | Repositorio |
| `contact` | Contacto |

> **Orden del formulario:** el bloque *Configuración* (estado, tipo, orden/página) aparece **antes** de *Información del Banner* para que el tipo quede claro antes de completar el contenido condicional.

</details>

<details>
<summary><strong>home_cards — Tarjetas de la página de inicio (máx. 6)</strong></summary>

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `title` | `string(40)` | Título de la tarjeta |
| `description` | `string(200)` | Descripción breve |
| `button_text` | `string` | Texto del botón (default: "Ver más") |
| `type` | `enum(pdf,url)` | Tipo de acción al hacer clic |
| `file_path` | `string` | Ruta del PDF (solo si `type = pdf`) |
| `url` | `string` | Enlace web (solo si `type = url`) |
| `order` | `integer` | Orden de aparición |
| `estado` | `boolean` | Activo / Inactivo |

</details>

<details>
<summary><strong>formal_education_sections — Educación Formal (máx. 6 secciones)</strong></summary>

Pertenecen siempre al área `educacion-comunicacion`. Existe **exactamente un registro por tipo de sección** — el campo `section` tiene restricción de unicidad en BD.

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `area_id` | `FK → areas.id` | Siempre el área de Educación y Comunicación |
| `section` | `enum` | Tipo de sección (ver tabla abajo) |
| `image` | `string` | Ícono o imagen representativa — **obligatorio** (JPG/PNG) |
| `pdf_file` | `string` | PDF adjunto — **obligatorio** |
| `url` | `string` (nullable) | Enlace externo opcional |
| `order` | `integer` | Orden de aparición |
| `active` | `boolean` | Activo / Inactivo |
| `created_by` / `updated_by` | `FK → users.id` | Auditoría |

**Tipos de sección (ENUM) — uno por sección, no repetible:**

| Valor (`section`) | Etiqueta visible | Descripción |
|:---|:---|:---|
| `generalities` | Generalidades | Información general del programa |
| `modalities` | Modalidades | Modalidades de estudio disponibles |
| `procedures` | Trámites | Trámites y procesos administrativos |
| `intern_commitments` | Compromisos del Estudiante | Compromisos del estudiante con el Instituto |
| `institute_commitments` | Compromisos del Instituto | Compromisos del Instituto con el estudiante |
| `access_conditions` | Condiciones para Acceder | Requisitos y condiciones de acceso |

> Tanto el **ícono/imagen** como el **PDF** son campos **obligatorios** al crear o editar una sección.

</details>

<details>
<summary><strong>courses — Cursos (con Soft Delete)</strong></summary>

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `area_id` | `FK → areas.id` | Área a la que pertenece el curso |
| `title` | `string(50)` | Título único del curso |
| `short_description` | `string(200)` | Descripción para tarjeta de vista previa |
| `main_image` | `string` | Imagen principal (16:9) |
| `full_description` | `longText` | Descripción completa (RichEditor) |
| `gallery_image_1/2/3` | `string` (nullable) | Galería opcional (hasta 3 imágenes) |
| `pdf_file` | `string` (nullable) | PDF adjunto (opcional) |
| `status` | `enum(active,finished,inactive)` | Estado del curso |
| `registration_link` | `string` (nullable) | URL del formulario de inscripción |
| `duration_hours` | `integer` (nullable) | Duración en horas |
| `order` | `integer` | Orden de visualización |
| `created_by` / `updated_by` | `FK → users.id` | Auditoría |

</details>

<details>
<summary><strong>educational_materials — Materiales Educativos</strong></summary>

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `area_id` | `FK → areas.id` | Siempre el área de Educación y Comunicación |
| `category` | `enum(early_childhood, school_adolescence)` | Categoría del material |
| `type` | `enum(guides_manuals, games)` | Tipo de material |
| `title` | `string(100)` | Título único por categoría |
| `short_description` | `string(300)` | Resumen para tarjeta (máx. 300 chars) |
| `main_image` | `string` | Imagen principal (393×390 px, JPG/PNG, máx. 2 MB) — **obligatoria** |
| `full_description` | `text` (nullable) | Descripción completa (no gestionada desde el panel) |
| `gallery_image_1` … `gallery_image_5` | `string` (nullable) | Galería de imágenes adicionales |
| `pdf_file` | `string` (nullable) | Documento PDF (opcional) |
| `order` | `integer` | Orden de visualización |
| `active` | `boolean` | Activo / Inactivo |
| `created_by` / `updated_by` | `FK → users.id` | Auditoría |

**Categorías y tipos disponibles:**

| Categoría | Valor en BD | Tipos disponibles |
|:---|:---|:---|
| Primera Infancia | `early_childhood` | Guías y Manuales / Juegos |
| Escolar y Adolescencia | `school_adolescence` | Guías y Manuales / Juegos |

> La columna **Imagen** no se muestra en el listado de la tabla del panel (solo aparece al editar). El campo `full_description` es nullable para permitir crear materiales sin necesidad de ese campo extendido.

</details>

<details>
<summary><strong>educational_material_groups — Grupos de Materiales (oculto del panel)</strong></summary>

Este módulo existe en la base de datos pero **no aparece en el menú del panel** (`shouldRegisterNavigation = false`). Sus registros son fijos y se crean con el seeder. El administrador no puede crear ni eliminar grupos.

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `category` | `enum(early_childhood, school_adolescence)` | Categoría del grupo |
| `type` | `enum(guides_manuals, games)` | Tipo del grupo |
| `title` | `string(100)` | Nombre del grupo |
| `slug` | `string` | Identificador URL |
| `description` | `string(300)` | Descripción de la tarjeta |
| `icon` | `string` | Ícono (PNG, máx. 1 MB) |
| `color` | `string` | Color de la tarjeta |
| `is_active` | `boolean` | Activo / Inactivo |
| `order` | `integer` | Orden de visualización |

**Grupos sembrados (no eliminar):**

| # | Categoría | Tipo | Slug |
|:---:|:---|:---|:---|
| 1 | Primera Infancia | Guías y Manuales | `guias-manuales-primera-infancia` |
| 2 | Primera Infancia | Juegos | `juegos-primera-infancia` |
| 3 | Escolar y Adolescencia | Guías y Manuales | `guias-manuales-escolar-adolescencia` |
| 4 | Escolar y Adolescencia | Juegos | `juegos-escolar-adolescencia` |

</details>

<details>
<summary><strong>publications — Publicaciones académicas</strong></summary>

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `area_id` | `FK → areas.id` | Siempre el área de Investigación |
| `title` | `string(50)` | Título único |
| `subtitle` | `string(100)` | Subtítulo (opcional) |
| `short_description` | `string(300)` | Descripción breve |
| `image` | `string` | Imagen de portada |
| `external_link` | `string` | URL de la publicación |
| `status` | `enum(active, inactive)` | Estado |
| `order` | `integer` | Orden de visualización |
| `created_by` / `updated_by` | `FK → users.id` | Auditoría |

</details>

<details>
<summary><strong>research_group — Grupo de Investigación (Singleton)</strong></summary>

Solo puede existir un registro. El modelo lanza una excepción al intentar crear un segundo.

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `area_id` | `FK → areas.id` | Siempre el área de Investigación |
| `name` | `string` | Nombre del grupo |
| `description` | `longText` | Descripción completa (RichEditor) |
| `mini_description` | `string` | Descripción breve |
| `link` | `string` | Enlace externo del grupo |
| `research_line_1` | `string` | Primera línea de investigación (requerida) |
| `research_line_2` | `string` | Segunda línea de investigación (requerida) |
| `research_line_3` | `string` (nullable) | Tercera línea (opcional) |
| `active` | `boolean` | Estado |
| `created_by` / `updated_by` | `FK → users.id` | Auditoría |

> `total_publications` es un **accessor calculado** — no existe como columna en la BD, se computa en tiempo real contando las publicaciones activas del área asociada.

</details>

<details>
<summary><strong>health_promotion_categories — Categorías de Salud (máx. 4)</strong></summary>

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `area_id` | `FK → areas.id` | Siempre el área de Proyección Social |
| `category` | `enum` | Clave interna de la categoría |
| `display_name` | `string` | Nombre visible en el sitio web |
| `image` | `string` | Imagen representativa (16:9) |
| `pdf_file` | `string` (nullable) | PDF general de la categoría |
| `order` | `integer` | Orden de aparición |
| `active` | `boolean` | Activo / Inactivo |
| `created_by` / `updated_by` | `FK → users.id` | Auditoría |

**Categorías sembradas con seeder (no eliminar):**

| # | Nombre | Clave (`category`) |
|:---:|:---|:---|
| 1 | Primera Infancia | `early_childhood` |
| 2 | Niñez | `childhood` |
| 3 | Mujer | `women` |
| 4 | Trabajadores | `workers` |

</details>

<details>
<summary><strong>health_promotion_items — Ítems de Salud</strong></summary>

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `category_id` | `FK → health_promotion_categories.id` | Categoría a la que pertenece |
| `title` | `string(100)` | Título del ítem |
| `short_description` | `string(150)` | Descripción breve |
| `order` | `integer` | Orden dentro de la categoría |
| `active` | `boolean` | Activo / Inactivo |
| `created_by` / `updated_by` | `FK → users.id` | Auditoría |

</details>

<details>
<summary><strong>repository_categories — Categorías del Repositorio</strong></summary>

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `title` | `string` | Nombre de la categoría |
| `slug` | `string` | URL amigable (generado automáticamente) |
| `description` | `text` | Descripción (opcional) |
| `image` | `string` | Imagen representativa |
| `order` | `integer` | Orden de aparición |
| `status` | `boolean` | Activo / Inactivo |

</details>

<details>
<summary><strong>repository_documents — Documentos del Repositorio</strong></summary>

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `repository_category_id` | `FK → repository_categories.id` | Categoría a la que pertenece |
| `title` | `string` | Título del documento |
| `authors` | `string` (nullable) | Autor(es) |
| `topic` | `string` (nullable) | Tema o etiqueta |
| `description` | `text` (nullable) | Descripción |
| `image` | `string` (nullable) | Imagen de portada |
| `document` | `string` (nullable) | Archivo PDF descargable |
| `order` | `integer` | Orden de aparición |
| `status` | `boolean` | Activo / Inactivo |

</details>

<details>
<summary><strong>institutional_resources — Recursos Institucionales (Soft Delete)</strong></summary>

Un único modelo gestiona dos tipos de contenido con campos distintos según el tipo.

| Campo | Tipo | Aplica a | Descripción |
|:---|:---:|:---|:---|
| `type` | `enum(interest_link, partner)` | Ambos | Tipo de recurso |
| `title` | `string` | `interest_link` | Título del link de interés |
| `url` | `string` | `interest_link` | URL del enlace |
| `name` | `string` | `partner` | Nombre del socio/aliado |
| `image` | `string` | `partner` | Logo del socio |
| `order` | `integer` | Ambos | Orden (independiente por tipo) |
| `active` | `boolean` | Ambos | Activo / Inactivo |
| `created_by` / `updated_by` | `FK → users.id` | Ambos | Auditoría |

</details>

---

## Almacenamiento de archivos

Todos los archivos subidos se guardan en `storage/app/public/` y son accesibles públicamente vía el enlace simbólico creado con `php artisan storage:link`.

| Directorio | Contenido | Formato | Dimensiones / Tamaño |
|:---|:---|:---:|:---:|
| `areas/images/` | Imagen principal del área | JPG/PNG | 393×390 px, máx. 2 MB |
| `areas/education/` | Imágenes sub-secciones educación | JPG/PNG | 1024×577 px, máx. 2 MB |
| `banners/` | Imágenes de banners | JPG/PNG | 1920×960 (main) / 1920×500 (secondary) |
| `company/` | Logo, favicon, PDFs institucionales | JPG/PNG/PDF | Variado |
| `courses/` | Imágenes y PDFs de cursos | JPG/PNG/PDF | Variado |
| `educational-materials/images/` | Imágenes de materiales educativos | JPG/PNG | 393×390 px, máx. 2 MB |
| `educational-materials/pdfs/` | PDFs de materiales educativos | PDF | Máx. 3 MB |
| `formal-education/` | Íconos y PDFs de educación formal | JPG/PNG/PDF | Variado |
| `health-promotion/` | Imágenes de categorías de salud | JPG/PNG | 16:9 |
| `news/` | Imágenes de noticias | JPG/PNG | 16:9 |
| `publications/` | Portadas de publicaciones | JPG/PNG | Variado |
| `repository/` | Documentos del repositorio | PDF | Máx. 10 MB |
| `team/` | Fotografías del equipo | JPG/PNG | 393×390 px |

> **Redimensionado automático:** los campos con `imageResizeMode('cover')` o `imageResizeMode('force')` usan `intervention/image` para recortar/escalar la imagen al tamaño exacto requerido. Si este paquete no está instalado (`composer install`), los campos de imagen fallarán con `UnableToRetrieveMetadata`.

---

## Grupos de navegación del panel

El menú lateral del panel administrativo se organiza en grupos temáticos:

```
Panel Admin
├── [Sin grupo — nivel superior]
│   ├── Empresa
│   ├── Equipo
│   ├── Áreas
│   ├── Valores
│   ├── Testimonios
│   ├── Noticias
│   └── Usuarios
│
├── Contenido Web
│   ├── Tarjetas Home
│   └── Banners
│
├── Educación y Comunicación
│   ├── Educación Formal
│   ├── Cursos
│   └── Materiales Educativos
│   [Grupos de Materiales — oculto, no aparece]
│
├── Proyección Social
│   ├── Categorías de Salud
│   └── Ítems de Salud
│
├── Investigación
│   ├── Publicaciones
│   └── Grupo de Investigación
│
├── Repositorio
│   ├── Categorías de Repositorio
│   └── Documentos
│
└── Institucional
    └── Recursos Institucionales
```

---

## Sistema de roles y permisos

El CMS usa `spatie/laravel-permission` con integración directa para Filament. Los roles y permisos se gestionan desde el panel en la sección **Usuarios**.

### Métodos de control de acceso en Resources

| Método | Efecto cuando retorna `false` |
|:---|:---|
| `canViewAny()` | El usuario no puede ver el listado del módulo |
| `canCreate()` | El botón "Nuevo" desaparece; no se puede crear |
| `canEdit($record)` | No puede editar registros existentes |
| `canDelete($record)` | No puede eliminar registros |
| `shouldRegisterNavigation()` | El módulo desaparece completamente del menú lateral |

### Módulos con restricciones especiales (no basadas en permisos)

| Módulo | Restricción | Motivo |
|:---|:---|:---|
| `Empresa` | `canCreate()` → `false` si ya existe 1 registro | Singleton |
| `Grupo de Investigación` | `canCreate()` → `false` si ya existe 1 registro | Singleton |
| `Áreas` | `canCreate()` → `false` si ya existen 3 registros | Límite de 3 áreas |
| `Tarjetas Home` | `canCreate()` → `false` si ya existen 6 registros | Límite de 6 tarjetas |
| `Categorías de Salud` | `canCreate()` → `false` si ya existen 4 registros | Límite de 4 categorías |
| `Educación Formal` | `canCreate()` → `false` si ya existen 6 registros | Máx. 1 por tipo de sección |
| `Grupos de Materiales` | `canCreate()` → `false` siempre + oculto del menú | Grupos fijos, no modificables |

> El rol **`SuperAdmin`** siempre tiene acceso completo a todos los módulos sin restricciones.

---

## Seeders

Al ejecutar `php artisan migrate --seed` se crean los datos base necesarios para que el sistema funcione. Los seeders de datos reales son:

| Seeder | Qué siembra | Dependencias |
|:---|:---|:---|
| `AreaSeeder` | Las **3 áreas** organizacionales con sus slugs fijos | Ninguna |
| `HealthPromotionCategorySeeder` | Las **4 categorías** de salud fijas | `AreaSeeder` (usa slug `proyeccion-social`) |
| `EducationalMaterialGroupSeeder` | Los **4 grupos** de materiales educativos | Ninguna |

> **Orden de ejecución obligatorio:** `AreaSeeder` → `HealthPromotionCategorySeeder`. El `EducationalMaterialGroupSeeder` puede ejecutarse en cualquier momento.

Para ejecutar seeders individuales:

```bash
php artisan db:seed --class=AreaSeeder
php artisan db:seed --class=HealthPromotionCategorySeeder
php artisan db:seed --class=EducationalMaterialGroupSeeder
```

---

## Migraciones

Lista completa de migraciones en orden de ejecución:

| Archivo | Tabla | Operación |
|:---|:---|:---|
| `2014_10_12_000000` | `users` | Crear tabla de usuarios |
| `2014_10_12_100000` | `password_reset_tokens` | Crear tabla de tokens de reset |
| `2019_08_19_000000` | `failed_jobs` | Crear tabla de trabajos fallidos |
| `2019_12_14_000001` | `personal_access_tokens` | Crear tabla de tokens de API |
| `2026_02_01_210950` | `roles`, `permissions`, `model_has_*` | Spatie: tablas de roles y permisos |
| `2026_02_04_010532` | `banners` | Crear tabla de banners |
| `2026_02_04_220802` | `companies` | Crear tabla de empresas/institución |
| `2026_02_05_000712` | `teams` | Crear tabla de equipo |
| `2026_02_05_060742` | `values` | Crear tabla de valores corporativos |
| `2026_02_06_214256` | `repository_categories` | Crear tabla de categorías de repositorio |
| `2026_02_06_214333` | `repository_documents` | Crear tabla de documentos de repositorio |
| `2026_02_11_002940` | `home_cards` | Crear tabla de tarjetas home |
| `2026_02_14_215649` | `areas` | Crear tabla de áreas |
| `2026_02_14_215723` | `formal_education_sections` | Crear tabla de educación formal |
| `2026_02_14_215753` | `courses` | Crear tabla de cursos |
| `2026_02_14_215815` | `educational_materials` | Crear tabla de materiales educativos |
| `2026_02_14_215842` | `publications` | Crear tabla de publicaciones |
| `2026_02_14_215917` | `research_group` | Crear tabla del grupo de investigación |
| `2026_02_14_215935` | `health_promotion_categories` | Crear tabla de categorías de salud |
| `2026_02_14_220019` | `health_promotion_items` | Crear tabla de ítems de salud |
| `2026_02_17_013513` | `institutional_resources` | Crear tabla de recursos institucionales |
| `2026_02_28_100000` | `testimonials` | Crear tabla de testimonios |
| `2026_02_28_400000` | `news` | Crear tabla de noticias |
| `2026_02_28_500000` | `research_lines` | Crear tabla de líneas de investigación |
| `2026_03_10_000001` | `formal_education_sections` | Agregar columna `title` y `url` |
| `2026_03_10_000002` | `educational_material_groups` | Crear tabla de grupos de materiales |
| `2026_03_10_000003` | `educational_materials` | Actualizar longitud de `short_description` |
| `2026_03_10_000004` | `educational_material_groups` | Agregar `icon`, `color`, `slug` |
| `2026_03_10_000005` | `educational_material_groups` | Agregar campo `order` |
| `2026_03_10_000006` | `areas` | Agregar imagen principal del área |
| `2026_03_10_000007` | `formal_education_sections` | Agregar `access_conditions` al ENUM + índice único |
| `2026_03_10_000008` | `areas` | Agregar columnas de sub-secciones educativas (imágenes + colores + descripciones) |
| `2026_03_10_000009` | `areas` | Renombrar columnas `_icon` → `_image` para consistencia |
| `2026_03_10_013049` | `news` | Agregar columna `slug` |
| `2026_03_10_015048` | `repository_categories` | Agregar columna `slug` |
| `2026_03_10_020917` | `health_promotion_items` | Aumentar longitud de `short_description` |
| `2026_03_10_034318` | `areas` | Agregar columna `image` (imagen principal) |
| `2026_03_10_042638` | `teams` | Agregar columna `profesion` |
| `2026_03_21_000001` | `educational_materials` | Hacer `full_description` nullable |

---

## Comandos útiles

| Comando | Descripción |
|:---|:---|
| `php artisan migrate` | Ejecutar migraciones pendientes |
| `php artisan migrate --seed` | Migrar y sembrar los datos base |
| `php artisan migrate:status` | Ver el estado de todas las migraciones |
| `php artisan migrate:rollback` | Revertir la última migración |
| `php artisan db:seed --class=NombreSeeder` | Ejecutar un seeder específico |
| `php artisan storage:link` | Crear enlace simbólico para archivos públicos |
| `php artisan make:filament-user` | Crear un nuevo usuario del panel |
| `php artisan route:clear` | Limpiar caché de rutas |
| `php artisan config:clear` | Limpiar caché de configuración |
| `php artisan optimize:clear` | Limpiar toda la caché de la aplicación |

---

## Referencia rápida por módulo

Guía condensada para el administrador del panel:

| Módulo | Ruta en el panel | Límite | Campos clave | Notas especiales |
|:---|:---|:---:|:---|:---|
| Empresa | `/admin/companies` | 1 | Logo, redes sociales, coordenadas | Solo edición, no se puede crear otro |
| Usuarios | `/admin/users` | — | Nombre, email, rol | Gestión de accesos al panel |
| Equipo | `/admin/teams` | — | Nombre, cargo, profesión, foto | Descripción no visible en listado |
| Áreas | `/admin/areas` | 3 | Nombre (fijo), imagen, coordinador | Nombre y slug no son editables |
| Valores | `/admin/values` | — | Título, descripción | Drag & drop para reordenar |
| Testimonios | `/admin/testimonials` | — | Nombre, perfil, testimonio, rating | Drag & drop para reordenar |
| Noticias | `/admin/news` | — | Título, extracto, imagen, contenido | Slug generado automáticamente |
| Banners | `/admin/banners` | — | Tipo, imagen, título | Comportamiento diferente según tipo |
| Tarjetas Home | `/admin/home-cards` | 6 | Título, tipo (PDF/URL) | Máx. 6 tarjetas activas |
| Educación Formal | `/admin/formal-education-sections` | 6 | Sección, ícono, PDF | Ícono y PDF son obligatorios |
| Cursos | `/admin/courses` | — | Título, área, estado, imagen | Tres estados: activo/finalizado/inactivo |
| Materiales Educativos | `/admin/educational-materials` | — | Categoría, tipo, título, imagen | Categoría: Primera Infancia / Escolar |
| Publicaciones | `/admin/publications` | — | Título, imagen, enlace externo | Solo para el área Investigación |
| Grupo de Investigación | `/admin/research-groups` | 1 | Nombre, descripción, líneas | Solo edición, no se puede crear otro |
| Categorías de Salud | `/admin/health-promotion-categories` | 4 | Nombre, imagen, PDF | 4 categorías fijas por seeder |
| Ítems de Salud | `/admin/health-promotion-items` | — | Título, descripción, categoría | Drag & drop dentro de cada categoría |
| Cat. Repositorio | `/admin/repository-categories` | — | Título, imagen | Slug generado automáticamente |
| Doc. Repositorio | `/admin/repository-documents` | — | Título, PDF, categoría | Agrupa bajo una categoría |
| Rec. Institucionales | `/admin/institutionals` | — | Tipo, título/nombre, URL/imagen | Links de interés y socios aliados |

---

## Historial de cambios

### v1.2.0 — 2026-03-21

#### Panel administrativo — comportamiento general
- **Listado de más reciente a más antiguo:** todos los módulos del panel ahora muestran los registros ordenados por `created_at DESC` como comportamiento predeterminado al cargar el listado. Esto aplica a los 20 recursos. El campo `order` sigue controlando la visualización en el sitio web; el orden en el panel es independiente.

#### Materiales Educativos (`EducationalMaterialResource`)
- **Columna de imagen eliminada del listado:** la columna `Imagen` ya no aparece en la tabla del panel, ya que presentaba errores de visualización. El campo sigue disponible en el formulario de edición.

#### Grupos de Materiales (`EducationalMaterialGroupResource`)
- **Módulo ocultado del menú lateral:** se añadió `shouldRegisterNavigation(): false` para que el módulo no aparezca en el panel. Los 4 grupos base (Primera Infancia / Escolar y Adolescencia × Guías y Manuales / Juegos) son predeterminados y no deben ser modificados por el administrador.

#### Base de datos
- **Nueva migración `2026_03_21_000001`:** hace el campo `full_description` de `educational_materials` nullable, eliminando el error `SQLSTATE[HY000]: 1364 Field 'full_description' doesn't have a default value` al crear materiales desde el panel.

---

### v1.1.0 — 2026-03-10

#### Dependencias
- Se añadió **`intervention/image ^3.11`** a `composer.json`. Requerida para que los campos `FileUpload` con `imageResizeMode()` puedan redimensionar imágenes al subirlas. Sin este paquete se produce el error `League\Flysystem\UnableToRetrieveMetadata`.

> Cada desarrollador que clone el repositorio debe ejecutar `composer install` para obtener este paquete.

#### Banners (`BannerResource` + tabla `banners`)
- **Orden del formulario:** la sección *Configuración* (estado, tipo, orden, página) ahora aparece **antes** de *Información del Banner*.
- **Subtítulo oculto en banners secundarios:** los campos `subtitle` y `subtitle_color` solo son visibles cuando el tipo es `main`.
- **Campo `order` condicional:** solo aparece y es requerido para banners `main`.

#### Áreas (`AreaResource` + tabla `areas`)
- **Nombre y slug de solo lectura:** deshabilitados en el formulario para evitar romper las rutas del frontend.
- **Campos de sub-sección visibles solo para `educacion-comunicacion`:** la sección de Educación Formal, No Formal y Materiales solo aparece en el área correcta.
- **Imágenes de sub-sección actualizadas:** de 74×119 px (PNG) a **1024×577 px** (JPG/PNG, máx. 2 MB).
- **Colores de tarjeta:** se añadieron tres campos `ColorPicker` para los colores de fondo de cada sub-sección.
- **Migraciones:** `000008` (agrega columnas) y `000009` (renombra columnas para consistencia).

#### Equipo (`TeamResource`)
- **Descripción eliminada del listado:** la columna `description` ya no aparece en la tabla del panel.
- **Límite de descripción aumentado:** de 200 a **1000 caracteres**.

#### Educación Formal (`FormalEducationSectionResource`)
- **Nueva sección `access_conditions`:** *Condiciones para Acceder* añadida al selector de tipo. Ahora existen 6 tipos posibles.
- **Ícono y PDF obligatorios:** ambos campos son ahora requeridos al crear o editar una sección.

---

## Licencia

Uso interno — Instituto Proinapsa.
