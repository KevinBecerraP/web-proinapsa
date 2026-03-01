# Instituto Proinapsa — CMS

Sistema de gestión de contenido (CMS) para el sitio web institucional del Instituto Proinapsa. Desarrollado con Laravel 10 y el panel de administración Filament 3. Permite gestionar toda la información del sitio web: páginas institucionales, noticias, cursos, publicaciones, repositorio de documentos, banners, testimonios y más.

---

## Stack tecnológico

| Capa | Tecnología | Versión |
|---|---|---|
| Backend | Laravel | ^10.10 |
| Lenguaje | PHP | ^8.1 |
| Panel admin | Filament | ~3.3 |
| Base de datos | MySQL | — |
| Autenticación API | Laravel Sanctum | ^3.3 |
| Roles y permisos | Spatie Roles & Permissions (integración Filament) | ^2.3 |
| Assets | Vite + Tailwind CSS | — |

---

## Requisitos previos

- PHP >= 8.1
- Composer
- Node.js >= 18
- MySQL >= 8.0

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

# 5. Configurar la base de datos en .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=institutoproinapsa
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Ejecutar migraciones y seeders
php artisan migrate --seed

# 7. Crear enlace simbólico para almacenamiento
php artisan storage:link

# 8. Compilar assets
npm run build

# 9. Crear el primer usuario administrador
php artisan make:filament-user

# 10. Levantar el servidor
php artisan serve
```

El panel de administración queda disponible en `/admin`.

---

## Estructura de directorios

```
institutoproinapsa-cms/
├── app/
│   ├── Filament/
│   │   └── Resources/              → Un Resource por módulo
│   │       ├── AreaResource.php
│   │       ├── BannerResource.php
│   │       ├── CompanyResource.php
│   │       ├── CourseResource.php
│   │       ├── EducationalMaterialResource.php
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
│   │       ├── ValuesResource.php
│   │       └── [NombreResource]/
│   │           └── Pages/
│   │               ├── ListXxx.php      → Tabla de listado
│   │               ├── CreateXxx.php    → Formulario de creación
│   │               └── EditXxx.php      → Formulario de edición
│   │
│   └── Models/                     → Modelos Eloquent
│       ├── Area.php
│       ├── Banner.php
│       ├── Company.php
│       ├── Course.php
│       ├── EducationalMaterial.php
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
│       └── Values.php
│
├── database/
│   ├── migrations/                 → Una migración por tabla/alteración
│   └── seeders/
│       ├── AreaSeeder.php
│       ├── HealthPromotionCategorySeeder.php
│       └── DatabaseSeeder.php
│
└── storage/app/public/             → Archivos subidos (imágenes, PDFs)
    ├── banners/
    ├── company/
    ├── courses/
    ├── educational-materials/
    ├── formal-education/
    ├── health-promotion/
    ├── news/
    ├── publications/
    ├── repository/
    └── team/
```

---

## Cómo funciona Filament (arquitectura del panel)

Cada módulo del CMS se compone de tres capas que trabajan juntas:

### 1. Modelo (`app/Models/`)
Define la tabla de la base de datos, los campos editables (`$fillable`), los tipos de datos (`$casts`), las relaciones Eloquent y la lógica automática en `boot()`.

### 2. Resource (`app/Filament/Resources/NombreResource.php`)
Define **qué** se puede hacer con el módulo:
- `form()` — Estructura del formulario para crear y editar registros (campos, validaciones, secciones)
- `table()` — Columnas, filtros, acciones y ordenamiento del listado
- `getPages()` — Qué rutas/páginas están disponibles para este módulo

### 3. Pages (`app/Filament/Resources/NombreResource/Pages/`)
Define **cuándo y cómo** se renderiza cada vista:
- `ListXxx.php` — Tabla paginada con listado (`/admin/nombre`)
- `CreateXxx.php` — Formulario vacío para nuevo registro (`/admin/nombre/create`)
- `EditXxx.php` — Formulario con datos del registro existente (`/admin/nombre/{id}/edit`)

---

## Patrones de diseño aplicados

### Auto-orden con reorganización
La mayoría de modelos asignan automáticamente el número de orden al crear un registro. Al eliminar, los órdenes restantes se reorganizan para mantener la secuencia sin huecos.

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

### Reordenamiento drag & drop
Las tablas con `->reorderable('order')` permiten arrastrar filas para cambiar el orden visualmente. El query base siempre aplica `->getEloquentQuery()->ordered()` para que la tabla refleje el orden correcto.

### Auditoría (created_by / updated_by)
Los modelos con auditoría registran automáticamente qué usuario de sistema creó o modificó cada registro, capturado en el `boot()`:

```php
static::creating(fn($m) => $m->created_by = auth()->id());
static::updating(fn($m) => $m->updated_by = auth()->id());
```

### Singleton (registro único)
`ResearchGroup` solo puede tener un registro. Si se intenta crear un segundo, el `boot()` lanza una excepción. El resource también implementa `canCreate()` que devuelve `false` si ya existe uno.

### Límite máximo de registros
- `HomeCard`: máximo 6 tarjetas — `canCreate()` retorna `false` si ya hay 6
- `Area`: máximo 3 áreas — `canCreate()` retorna `false` si ya hay 3
- `HealthPromotionCategory`: máximo 4 categorías

### Limpieza automática de archivos
Los modelos `Company` y `News` (y otros) eliminan automáticamente del almacenamiento las imágenes antiguas cuando se actualiza o elimina un registro, usando los eventos `updating` y `deleting` del modelo.

### Soft Deletes
`Course` e `Institutional` usan `SoftDeletes`. Los registros eliminados no se borran físicamente de la base de datos; se marcan con el campo `deleted_at`. Permiten recuperación futura si fuera necesario.

### Scopes Eloquent reutilizables
Todos los modelos implementan:
- `scopeActive($query)` — filtra registros con `active = true` (o `status = 'active'`)
- `scopeOrdered($query)` — ordena por el campo `order` ascendente

### Campos condicionales en formularios
Algunos formularios muestran u ocultan campos según el valor de otro campo (usando `->live()` + `->visible(fn($get) => ...)`). Ejemplo: `Banner` muestra el selector de página solo cuando el tipo es `secondary`. `HomeCard` muestra el campo de archivo o URL según el tipo seleccionado.

### Accessors dinámicos
Algunos modelos tienen accessors que calculan valores sin columna en la base de datos. Ejemplo: `ResearchGroup::getTotalPublicationsAttribute()` cuenta las publicaciones activas del área en tiempo real.

---

## Base de datos — todas las tablas

### `users`
Tabla estándar de Laravel. Almacena los usuarios del panel de administración. Se extiende con roles y permisos de Spatie.

---

### `companies` — Información institucional
Registro único (singleton). Contiene toda la configuración general del sitio web.

| Campo | Descripción |
|---|---|
| `business_name` | Razón social de la institución |
| `slogan` | Eslogan |
| `description` | Descripción general |
| `address` | Dirección física |
| `phone_1` … `phone_5` | Teléfonos de contacto (hasta 5) |
| `email_1` … `email_3` | Correos de contacto (hasta 3) |
| `facebook_link` … `threads_link` | Redes sociales (Facebook, Instagram, YouTube, X, WhatsApp, Threads) |
| `logo` | Logo principal del sitio (725×121 px) |
| `favicon` | Ícono de la pestaña del navegador (132×128 px) |
| `video_link` | Link de video institucional |
| `privacy_policy_pdf` | Política de protección de datos (PDF) |
| `mission_title` / `mission_description` / `mission_image_1/2/3` | Sección Misión |
| `vision_title` / `vision_description` / `vision_image` | Sección Visión (imagen 960×523 px) |
| `trajectory_title` / `trajectory_description` / `trajectory_image` | Trayectoria e historia (descripción máx. 500 chars) |
| `methodology_title` / `methodology_description` / `methodology_image` | Metodología (descripción con RichEditor, máx. 800 chars) |
| `latitude` / `longitude` | Coordenadas para Google Maps |

---

### `teams` — Equipo de trabajo

| Campo | Descripción |
|---|---|
| `name` | Nombre completo del integrante |
| `position` | Cargo |
| `description` | Descripción profesional breve (máx. 200 chars) |
| `image` | Fotografía del integrante (393×390 px) |
| `status` | Activo/Inactivo |

---

### `areas` — Áreas organizacionales (máx. 3)
Cada área tiene un coordinador asignado desde el equipo. Los módulos de contenido (cursos, publicaciones, etc.) pertenecen a un área.

| Campo | Descripción |
|---|---|
| `name` | Nombre del área |
| `slug` | Identificador URL (`educacion-comunicacion`, `investigacion`, `proyeccion-social`) |
| `description` | Descripción con formato (RichEditor) |
| `icon` | Heroicon name (ej: `heroicon-o-academic-cap`) |
| `coordinator_id` | FK → `teams.id` (coordinador del área, obligatorio) |
| `order` / `active` | Orden y estado |
| `created_by` / `updated_by` | Auditoría |

**Relaciones:** `Area` tiene muchos `FormalEducationSection`, `Course`, `EducationalMaterial`, `Publication`, `HealthPromotionCategory`, y uno `ResearchGroup`. Un `Team` puede ser coordinador de un `Area` (relación HasOne inversa).

**Áreas base (sembradas con seeder):**
1. Educación y Comunicación (`educacion-comunicacion`)
2. Investigación (`investigacion`)
3. Proyección Social (`proyeccion-social`)

---

### `values` — Valores corporativos

| Campo | Descripción |
|---|---|
| `title` | Nombre del valor (ej: Integridad) |
| `description` | Descripción del valor (máx. 500 chars) |
| `order` / `status` | Orden y estado |

---

### `testimonials` — Testimonios

| Campo | Descripción |
|---|---|
| `name` | Nombre de la persona |
| `profile` | Perfil libre (ej: Estudiante, Docente, Médico) |
| `testimonial` | Texto del testimonio (máx. 600 chars) |
| `rating` | Calificación de 1 a 5 estrellas |
| `order` / `active` | Orden y estado |
| `created_by` / `updated_by` | Auditoría |

---

### `news` — Noticias

| Campo | Descripción |
|---|---|
| `title` | Título de la noticia (máx. 150 chars) |
| `excerpt` | Resumen para el listado (máx. 300 chars) |
| `content` | Contenido completo con formato (RichEditor) |
| `image` | Imagen principal (relación 16:9) |
| `order` / `active` | Orden y estado |
| `created_by` / `updated_by` | Auditoría |

---

### `banners` — Banners del sitio
Existen dos tipos que no se mezclan:
- **Principal** (`main`): página de inicio, mínimo 1920×960 px
- **Secundario** (`secondary`): páginas internas, mínimo 1905×496 px. Solo uno por página.

| Campo | Descripción |
|---|---|
| `title` / `title_color` | Texto y color del título |
| `subtitle` / `subtitle_color` | Texto y color del subtítulo |
| `type` | `main` o `secondary` |
| `page` | Página asignada (solo `secondary`): `about_us`, `what_we_do`, `research`, `news`, etc. |
| `image` | Imagen (validada por dimensiones mínimas según tipo) |
| `status` | Activo/Inactivo |
| `order` | Orden de visualización |
| `button_link` / `button_color` | Botón de acción opcional |

---

### `home_cards` — Tarjetas de la página de inicio (máx. 6)

| Campo | Descripción |
|---|---|
| `title` | Título de la tarjeta (máx. 40 chars) |
| `description` | Descripción breve (máx. 200 chars) |
| `button_text` | Texto del botón (default: "Ver más") |
| `type` | `pdf` (archivo descargable) o `url` (enlace externo) |
| `file_path` | Ruta del PDF (si `type = pdf`) |
| `url` | Enlace web (si `type = url`) |
| `order` / `estado` | Orden y estado |

---

### `formal_education_sections` — Educación Formal

Secciones de contenido del módulo de Educación Formal. Pertenecen al área `educacion-comunicacion`.

| Campo | Descripción |
|---|---|
| `area_id` | FK → `areas.id` |
| `section` | Sección: `generalities`, `modalities`, `procedures`, `intern_commitments`, `institute_commitments` |
| `title` | Título único dentro de la sección (máx. 50 chars) |
| `description` | Contenido con formato (RichEditor) |
| `image` / `pdf_file` / `url` | Multimedia opcional |
| `order` / `active` | Orden y estado |
| `created_by` / `updated_by` | Auditoría |

---

### `courses` — Cursos
Cursos del área de Educación y Comunicación. Soporta Soft Deletes.

| Campo | Descripción |
|---|---|
| `area_id` | FK → `areas.id` |
| `title` | Título único (máx. 50 chars) |
| `short_description` | Descripción para tarjeta de vista previa (máx. 200 chars) |
| `main_image` | Imagen principal (16:9) |
| `full_description` | Descripción completa (RichEditor) |
| `gallery_image_1/2/3` | Galería opcional (hasta 3 imágenes) |
| `pdf_file` | PDF adjunto (opcional) |
| `status` | `active`, `finished` o `inactive` |
| `registration_link` | URL del formulario de inscripción |
| `duration_hours` | Duración en horas (opcional) |
| `order` | Orden de visualización |
| `created_by` / `updated_by` | Auditoría |

---

### `educational_materials` — Materiales Educativos

| Campo | Descripción |
|---|---|
| `area_id` | FK → `areas.id` |
| `category` | `early_childhood` o `school_adolescence` |
| `type` | `guides_manuals` o `games` |
| `title` | Título único por categoría (máx. 50 chars) |
| `short_description` | Resumen para tarjeta (máx. 200 chars) |
| `main_image` | Imagen principal |
| `full_description` | Descripción completa (RichEditor) |
| `gallery_image_1` … `gallery_image_5` | Galería (hasta 5 imágenes) |
| `pdf_file` | Documento PDF (opcional) |
| `order` / `active` | Orden y estado |
| `created_by` / `updated_by` | Auditoría |

---

### `publications` — Publicaciones académicas

| Campo | Descripción |
|---|---|
| `area_id` | FK → `areas.id` (siempre Investigación) |
| `title` | Título único (máx. 50 chars) |
| `subtitle` | Subtítulo (opcional, máx. 100 chars) |
| `short_description` | Descripción breve (máx. 300 chars) |
| `image` | Imagen de portada |
| `external_link` | URL de la publicación externa |
| `status` | `active` o `inactive` |
| `order` | Orden de visualización |
| `created_by` / `updated_by` | Auditoría |

---

### `research_group` — Grupo de Investigación (singleton)

Solo puede existir un registro. El modelo lanza una excepción si se intenta crear un segundo.

| Campo | Descripción |
|---|---|
| `area_id` | FK → `areas.id` (siempre Investigación) |
| `name` | Nombre del grupo |
| `description` | Descripción completa (RichEditor) |
| `mini_description` | Descripción breve |
| `link` | Enlace externo del grupo |
| `research_line_1` | Primera línea de investigación (requerida) |
| `research_line_2` | Segunda línea de investigación (requerida) |
| `research_line_3` | Tercera línea de investigación (opcional) |
| `active` | Estado |
| `created_by` / `updated_by` | Auditoría |

> `total_publications` es un **accessor calculado** (no columna): cuenta las publicaciones activas del área asociada.

---

### `health_promotion_categories` — Categorías de Salud (máx. 4)

| Campo | Descripción |
|---|---|
| `area_id` | FK → `areas.id` (siempre Proyección Social) |
| `category` | Clave interna: `early_childhood`, `childhood`, `women`, `workers` |
| `display_name` | Nombre visible en el sitio |
| `image` | Imagen representativa (16:9) |
| `pdf_file` | PDF general de la categoría (opcional) |
| `order` / `active` | Orden y estado |
| `created_by` / `updated_by` | Auditoría |

**Categorías base (sembradas con seeder):**
1. Primera Infancia (`early_childhood`)
2. Niñez (`childhood`)
3. Mujer (`women`)
4. Trabajadores (`workers`)

---

### `health_promotion_items` — Ítems de Salud

Viñetas de contenido que pertenecen a cada categoría de salud.

| Campo | Descripción |
|---|---|
| `category_id` | FK → `health_promotion_categories.id` |
| `title` | Título del ítem (máx. 100 chars) |
| `short_description` | Descripción breve (máx. 150 chars) |
| `order` / `active` | Orden y estado |
| `created_by` / `updated_by` | Auditoría |

---

### `repository_categories` — Categorías del Repositorio

| Campo | Descripción |
|---|---|
| `title` | Nombre de la categoría |
| `description` | Descripción (opcional) |
| `image` | Imagen representativa |
| `order` / `status` | Orden y estado |

---

### `repository_documents` — Documentos del Repositorio

| Campo | Descripción |
|---|---|
| `repository_category_id` | FK → `repository_categories.id` |
| `title` | Título del documento |
| `authors` | Autor(es) (opcional) |
| `topic` | Tema/etiqueta (opcional) |
| `description` | Descripción (opcional) |
| `image` | Imagen de portada (opcional) |
| `document` | Archivo PDF descargable (opcional) |
| `order` / `status` | Orden y estado |

---

### `institutional_resources` — Recursos Institucionales

Un único modelo gestiona dos tipos de contenido. Soporta Soft Deletes. El orden se gestiona independientemente por tipo.

| Campo | Descripción |
|---|---|
| `type` | `interest_link` (Link de Interés) o `partner` (Socio/Aliado) |
| `title` | Título del link (solo `interest_link`) |
| `url` | URL del enlace (solo `interest_link`) |
| `name` | Nombre del socio/aliado (solo `partner`) |
| `image` | Logo del socio (solo `partner`) |
| `order` / `active` | Orden y estado |
| `created_by` / `updated_by` | Auditoría |

---

## Grupos de navegación del panel

| Grupo | Módulos incluidos |
|---|---|
| *(Sin grupo — globales)* | Empresa, Equipo, Áreas, Valores, Testimonios, Noticias, Usuarios |
| Contenido Web | Tarjetas Home, Banners |
| Educación y Comunicación | Educación Formal, Cursos, Materiales Educativos |
| Proyección Social | Categorías de Salud, Ítems de Salud |
| Investigación | Publicaciones, Grupo de Investigación |
| Repositorio | Categorías de Repositorio, Documentos |
| Institucional | Recursos Institucionales |

---

## Sistema de roles y permisos

El CMS usa `spatie/laravel-permission` con integración directa para Filament. Los roles y permisos se gestionan desde el propio panel en la sección **Usuarios**.

Los resources que implementan control de acceso granular definen:

```php
public static function canViewAny(): bool { /* verifica permiso 'listXxx' */ }
public static function canCreate(): bool  { /* verifica permiso 'createXxx' */ }
public static function canEdit($record): bool   { /* verifica permiso 'editXxx' */ }
public static function canDelete($record): bool { /* verifica permiso 'deleteXxx' */ }
public static function shouldRegisterNavigation(): bool { /* oculta del menú si no tiene acceso */ }
```

El rol `SuperAdmin` siempre tiene acceso completo a todos los módulos.

---

## Seeders

Al ejecutar `php artisan migrate --seed` se crean automáticamente los datos base:

| Seeder | Qué siembra |
|---|---|
| `AreaSeeder` | Las 3 áreas: Educación y Comunicación, Investigación, Proyección Social |
| `HealthPromotionCategorySeeder` | Las 4 categorías: Primera Infancia, Niñez, Mujer, Trabajadores |

> **Nota**: El orden de ejecución es obligatorio. `AreaSeeder` debe ir antes de `HealthPromotionCategorySeeder` porque las categorías de salud dependen de que exista el área `proyeccion-social`.

---

## Validaciones estándar del campo Orden

Todos los campos `order` de los formularios siguen el mismo patrón:

- **Requerido** — no puede quedar vacío
- **Entero positivo** — solo números enteros mayores a 0 (1, 2, 3...)
- **Único** — no puede repetirse con otro registro del mismo modelo
- **Auto-asignado** — el valor por defecto es `(max('order') ?? 0) + 1`
- **Reordenable** — las tablas permiten arrastrar filas para cambiar el orden visualmente

---

## Comandos útiles

```bash
# Ejecutar migraciones pendientes
php artisan migrate

# Ver estado de todas las migraciones
php artisan migrate:status

# Revertir la última migración
php artisan migrate:rollback

# Limpiar caché de rutas y configuración
php artisan route:clear && php artisan config:clear

# Limpiar toda la caché
php artisan optimize:clear

# Crear enlace simbólico para storage (imágenes y PDFs públicos)
php artisan storage:link

# Crear un nuevo usuario del panel
php artisan make:filament-user
```

---

## Licencia

Uso interno — Instituto Proinapsa.
