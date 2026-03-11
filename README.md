# Instituto Proinapsa — CMS

![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?style=flat&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-3.x-F59E0B?style=flat&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=flat&logo=mysql&logoColor=white)
![Licencia](https://img.shields.io/badge/Licencia-Uso_Interno-6B7280?style=flat)

Sistema de gestión de contenido **(CMS)** para el sitio web institucional del **Instituto Proinapsa**. Desarrollado con **Laravel 10** y el panel administrativo **Filament 3**, centraliza la gestión de todo el contenido del sitio desde un único panel: páginas institucionales, noticias, cursos, publicaciones, repositorio de documentos, banners, testimonios y más.

---

## Tabla de contenido

- [Stack tecnológico](#stack-tecnológico)
- [Módulos del CMS](#módulos-del-cms)
- [Requisitos previos](#requisitos-previos)
- [Instalación](#instalación)
- [Estructura de directorios](#estructura-de-directorios)
- [Arquitectura del panel (Filament)](#arquitectura-del-panel-filament)
- [Patrones de diseño](#patrones-de-diseño)
- [Base de datos](#base-de-datos)
- [Grupos de navegación del panel](#grupos-de-navegación-del-panel)
- [Sistema de roles y permisos](#sistema-de-roles-y-permisos)
- [Seeders](#seeders)
- [Comandos útiles](#comandos-útiles)
- [Historial de cambios](#historial-de-cambios)

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

El sistema cuenta con **18 módulos** de gestión de contenido. La siguiente tabla resume sus capacidades:

| Módulo | Tabla | Límite | Reordenable | Estado | Imágenes / Archivos | Auditoría | Soft Delete |
|:---|:---|:---:|:---:|:---:|:---:|:---:|:---:|
| Empresa | `companies` | Singleton | — | — | Sí | — | — |
| Equipo | `teams` | — | — | Sí | Sí | — | — |
| Áreas | `areas` | 3 | Sí | Sí | Sí | Sí | — |
| Valores Corporativos | `values` | — | Sí | Sí | — | — | — |
| Testimonios | `testimonials` | — | Sí | Sí | — | Sí | — |
| Noticias | `news` | — | Sí | Sí | Sí | Sí | — |
| Banners | `banners` | — | Sí (solo main) | Sí | Sí | — | — |
| Tarjetas Home | `home_cards` | 6 | Sí | Sí | PDF / URL | — | — |
| Educación Formal | `formal_education_sections` | 6 (1 por tipo) | Sí | Sí | Sí + PDF | Sí | — |
| Cursos | `courses` | — | Sí | 3 estados | Sí | Sí | Sí |
| Materiales Educativos | `educational_materials` | — | Sí | Sí | Sí | Sí | — |
| Publicaciones | `publications` | — | Sí | Sí | Sí | Sí | — |
| Grupo de Investigación | `research_group` | Singleton | — | Sí | — | Sí | — |
| Categorías de Salud | `health_promotion_categories` | 4 | Sí | Sí | Sí | Sí | — |
| Ítems de Salud | `health_promotion_items` | — | Sí | Sí | — | Sí | — |
| Categorías de Repositorio | `repository_categories` | — | Sí | Sí | Sí | — | — |
| Documentos de Repositorio | `repository_documents` | — | Sí | Sí | PDF | — | — |
| Recursos Institucionales | `institutional_resources` | — | Sí | Sí | Sí | Sí | Sí |

---

## Requisitos previos

| Requisito | Versión mínima | Notas |
|:---|:---:|:---|
| PHP | 8.1 | Extensiones requeridas: `mbstring`, `xml`, `curl`, `pdo_mysql`, `gd` o `imagick` |
| Composer | 2.x | Gestión de dependencias PHP |
| Node.js | 18 | Compilación de assets con Vite |
| MySQL | 8.0 | Motor de base de datos relacional |

> **Nota:** La extensión `gd` o `imagick` de PHP es necesaria para que `intervention/image` pueda redimensionar imágenes automáticamente al subirlas.

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

> El panel de administración queda disponible en **`http://localhost:8000/admin`**.

---

## Estructura de directorios

```
institutoproinapsa-cms/
├── app/
│   ├── Filament/
│   │   └── Resources/              ← Un Resource por módulo
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
│   │               ├── ListXxx.php       ← Tabla de listado
│   │               ├── CreateXxx.php     ← Formulario de creación
│   │               └── EditXxx.php       ← Formulario de edición
│   │
│   └── Models/                     ← Modelos Eloquent
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
│   ├── migrations/                 ← Una migración por tabla/alteración
│   └── seeders/
│       ├── AreaSeeder.php
│       ├── HealthPromotionCategorySeeder.php
│       └── DatabaseSeeder.php
│
└── storage/app/public/             ← Archivos subidos (imágenes, PDFs)
    ├── areas/
    │   ├── images/                 ← Imagen principal del área (393×390 px)
    │   └── education/              ← Imágenes de sub-secciones (1024×577 px)
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

## Arquitectura del panel (Filament)

Cada módulo del CMS se compone de **3 capas** que trabajan juntas:

| Capa | Archivo | Responsabilidad |
|:---|:---|:---|
| **Model** | `app/Models/Nombre.php` | Estructura de BD, reglas de negocio, relaciones Eloquent, lógica en `boot()` |
| **Resource** | `app/Filament/Resources/NombreResource.php` | Define `form()`, `table()` y `getPages()` — qué puede hacer el módulo |
| **Pages** | `Resources/NombreResource/Pages/*.php` | Controla cuándo y cómo se renderiza cada vista |

### Rutas generadas por módulo

| Página | Clase | Ruta |
|:---|:---|:---|
| Listado | `ListXxx.php` | `/admin/nombre` |
| Crear | `CreateXxx.php` | `/admin/nombre/create` |
| Editar | `EditXxx.php` | `/admin/nombre/{id}/edit` |

---

## Patrones de diseño

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

### Validaciones del campo `order`

Todos los campos `order` del sistema siguen el mismo patrón de validación:

| Regla | Detalle |
|:---|:---|
| Requerido | No puede quedar vacío (solo para banners de tipo `main`) |
| Entero positivo | Solo valores > 0 (1, 2, 3…) |
| Único | No puede repetirse con otro registro del mismo modelo |
| Auto-asignado | Valor por defecto: `(max('order') ?? 0) + 1` |
| Reordenable | Las tablas permiten drag & drop para cambiar el orden visualmente |

### Auditoría (created_by / updated_by)

```php
static::creating(fn($m) => $m->created_by = auth()->id());
static::updating(fn($m) => $m->updated_by = auth()->id());
```

### Catálogo de patrones aplicados

| Patrón | Descripción | Aplica a |
|:---|:---|:---|
| **Singleton** | Solo puede existir un registro. `canCreate()` retorna `false` si ya hay uno | `ResearchGroup`, `Company` |
| **Límite máximo** | `canCreate()` retorna `false` al alcanzar el tope configurado | `HomeCard` (6), `Area` (3), `HealthPromotionCategory` (4) |
| **Limpieza de archivos** | Elimina del storage archivos antiguos al actualizar o eliminar un registro | `Company`, `News` y otros |
| **Soft Deletes** | Registros marcados con `deleted_at` en vez de borrarse físicamente | `Course`, `Institutional` |
| **Campos condicionales** | Campos que se muestran u ocultan según el valor de otro (`->live()` + `->visible()`) | `Banner` (subtítulo y orden por tipo), `HomeCard` (PDF vs URL), `Area` (sub-secciones solo para educación) |
| **Campos de solo lectura** | Campos deshabilitados (`->disabled()->dehydrated()`) — visibles pero no editables, se siguen guardando | `Area` (nombre y slug fijos) |
| **Contador de caracteres en vivo** | Contador de caracteres actualizado en tiempo real con `->live()->hint()` | `Banner` (subtítulo, máx. 60 chars) |
| **Accessors dinámicos** | Valores calculados sin columna en base de datos | `ResearchGroup::getTotalPublicationsAttribute()` |
| **Reordenamiento drag & drop** | `->reorderable('order')` con `getEloquentQuery()->ordered()` | Todos los módulos con campo `order` |

---

## Base de datos

### Diagrama de relaciones

```
users
 ├── areas                          (created_by, updated_by)
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
 ├── teams                          (coordinator_id → teams.id)
 ├── formal_education_sections      (area_id)
 ├── courses                        (area_id)
 ├── educational_materials          (area_id)
 ├── publications                   (area_id)
 ├── research_group                 (area_id)
 └── health_promotion_categories    (area_id)

health_promotion_categories
 └── health_promotion_items         (category_id)

repository_categories
 └── repository_documents           (repository_category_id)
```

### Resumen de tablas

| # | Tabla | Propósito | Cantidad | Relaciones principales |
|:---:|:---|:---|:---:|:---|
| 1 | `users` | Usuarios del panel | Ilimitado | — |
| 2 | `companies` | Información institucional | 1 (singleton) | — |
| 3 | `teams` | Equipo de trabajo | Ilimitado | `areas` (coordinador) |
| 4 | `areas` | Áreas organizacionales | Máx. 3 | `teams`, `courses`, `publications`… |
| 5 | `values` | Valores corporativos | Ilimitado | — |
| 6 | `testimonials` | Testimonios de usuarios | Ilimitado | `users` (auditoría) |
| 7 | `news` | Noticias | Ilimitado | `users` (auditoría) |
| 8 | `banners` | Banners main y secondary | Ilimitado | — |
| 9 | `home_cards` | Tarjetas de la página de inicio | Máx. 6 | — |
| 10 | `formal_education_sections` | Contenido de educación formal | Máx. 6 (uno por tipo) | `areas` |
| 11 | `courses` | Cursos | Ilimitado | `areas` |
| 12 | `educational_materials` | Materiales educativos | Ilimitado | `areas` |
| 13 | `publications` | Publicaciones académicas | Ilimitado | `areas` |
| 14 | `research_group` | Grupo de investigación | 1 (singleton) | `areas` |
| 15 | `health_promotion_categories` | Categorías de salud | Máx. 4 | `areas` |
| 16 | `health_promotion_items` | Ítems de salud | Ilimitado | `health_promotion_categories` |
| 17 | `repository_categories` | Categorías del repositorio | Ilimitado | — |
| 18 | `repository_documents` | Documentos del repositorio | Ilimitado | `repository_categories` |
| 19 | `institutional_resources` | Links e instituciones aliadas | Ilimitado | `users` (auditoría) |

---

### Detalle de campos por tabla

<details>
<summary><strong>companies — Información institucional (Singleton)</strong></summary>

| Campo | Descripción |
|:---|:---|
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
| `trajectory_title` / `trajectory_description` / `trajectory_image` | Trayectoria e historia (máx. 500 chars) |
| `methodology_title` / `methodology_description` / `methodology_image` | Metodología (RichEditor, máx. 800 chars) |
| `latitude` / `longitude` | Coordenadas para Google Maps |

</details>

<details>
<summary><strong>teams — Equipo de trabajo</strong></summary>

| Campo | Descripción |
|:---|:---|
| `name` | Nombre completo del integrante |
| `position` | Cargo |
| `description` | Descripción profesional (máx. 1000 chars — no se muestra en el listado de la tabla) |
| `image` | Fotografía del integrante (393×390 px) |
| `status` | Activo / Inactivo |

> La columna `description` se omite en el listado de la tabla del panel para mantener la vista compacta. Solo es visible al abrir el formulario de edición.

</details>

<details>
<summary><strong>areas — Áreas organizacionales (máx. 3)</strong></summary>

Los módulos de contenido (cursos, publicaciones, etc.) pertenecen a un área. Cada área tiene un coordinador asignado desde el equipo.

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `name` | `string(100)` | Nombre del área — **solo lectura**, fijado al crear |
| `slug` | `string(100)` | Identificador URL — **solo lectura**, fijado al crear |
| `description` | `text` | Descripción con formato (RichEditor) |
| `icon` | `string(100)` | Heroicon name (ej: `heroicon-o-academic-cap`) |
| `image` | `string` | Imagen principal del área (393×390 px, JPG/PNG, máx. 2 MB) |
| `coordinator_id` | `FK → teams.id` | Coordinador del área (obligatorio) |
| `order` / `active` | — | Orden y estado |
| `created_by` / `updated_by` | `FK → users.id` | Auditoría |

**Campos adicionales — solo para el área `educacion-comunicacion`:**

Estos campos se muestran en el formulario **únicamente** cuando el área tiene el slug `educacion-comunicacion`. Gestionan el contenido introductorio de las tres sub-secciones de esa área.

| Campo | Tipo | Descripción |
|:---|:---:|:---|
| `formal_education_image` | `string` | Imagen de Educación Formal (1024×577 px, JPG/PNG, máx. 2 MB) |
| `formal_education_color` | `string(20)` | Color de fondo de la tarjeta de Educación Formal (hex, ej: `#3B82F6`) |
| `formal_education_description` | `text` | Texto introductorio de Educación Formal (máx. 1000 chars) |
| `non_formal_education_image` | `string` | Imagen de Educación No Formal (1024×577 px, JPG/PNG, máx. 2 MB) |
| `non_formal_education_color` | `string(20)` | Color de fondo de la tarjeta de Educación No Formal |
| `non_formal_education_description` | `text` | Texto introductorio de Educación No Formal (máx. 1000 chars) |
| `educational_materials_image` | `string` | Imagen de Materiales Educativos (1024×577 px, JPG/PNG, máx. 2 MB) |
| `educational_materials_color` | `string(20)` | Color de fondo de la tarjeta de Materiales Educativos |
| `educational_materials_description` | `text` | Texto introductorio de Materiales Educativos (máx. 1000 chars) |

**Áreas sembradas con seeder:**

| # | Nombre | Slug |
|:---:|:---|:---|
| 1 | Educación y Comunicación | `educacion-comunicacion` |
| 2 | Investigación | `investigacion` |
| 3 | Proyección Social | `proyeccion-social` |

> Los campos `name` y `slug` están marcados como **solo lectura** (`->disabled()->dehydrated()`) para garantizar que los slugs del sistema nunca cambien, ya que el frontend los usa para enrutar a las páginas de cada área.

</details>

<details>
<summary><strong>values — Valores corporativos</strong></summary>

| Campo | Descripción |
|:---|:---|
| `title` | Nombre del valor (ej: Integridad) |
| `description` | Descripción del valor (máx. 500 chars) |
| `order` / `status` | Orden y estado |

</details>

<details>
<summary><strong>testimonials — Testimonios</strong></summary>

| Campo | Descripción |
|:---|:---|
| `name` | Nombre de la persona |
| `profile` | Perfil libre (ej: Estudiante, Docente, Médico) |
| `testimonial` | Texto del testimonio (máx. 600 chars) |
| `rating` | Calificación de 1 a 5 estrellas |
| `order` / `active` | Orden y estado |
| `created_by` / `updated_by` | Auditoría → `users.id` |

</details>

<details>
<summary><strong>news — Noticias</strong></summary>

| Campo | Descripción |
|:---|:---|
| `title` | Título de la noticia (máx. 150 chars) |
| `excerpt` | Resumen para el listado (máx. 300 chars) |
| `content` | Contenido completo con formato (RichEditor) |
| `image` | Imagen principal (relación 16:9) |
| `order` / `active` | Orden y estado |
| `created_by` / `updated_by` | Auditoría → `users.id` |

</details>

<details>
<summary><strong>banners — Banners del sitio (2 tipos)</strong></summary>

Existen dos tipos que no se mezclan:
- **Principal** (`main`): página de inicio, dimensiones exactas 1920×960 px.
- **Secundario** (`secondary`): páginas internas, dimensiones exactas 1920×500 px. Solo uno activo por página.

**Comportamiento condicional del formulario:**

| Campo | Banner Principal (`main`) | Banner Secundario (`secondary`) |
|:---|:---:|:---:|
| `title` | Requerido (máx. 100 chars) | Requerido (máx. 100 chars) |
| `title_color` | Requerido | Requerido |
| `subtitle` | Opcional (máx. 60 chars, con contador en vivo) | **Oculto** |
| `subtitle_color` | Requerido | **Oculto** |
| `order` | Requerido (posición de aparición en el carrusel) | **Oculto** |
| `page` | **Oculto** | Requerido (página destino, única por página) |

| Campo | Descripción |
|:---|:---|
| `title` / `title_color` | Texto y color del título |
| `subtitle` / `subtitle_color` | Texto y color del subtítulo (solo para banners principales; con contador en vivo hasta 60 chars) |
| `type` | `main` o `secondary` |
| `page` | Página asignada (solo `secondary`): `about_us`, `what_we_do`, `research`, `news`, etc. |
| `image` | Imagen con validación de dimensiones exactas según tipo |
| `status` | Activo / Inactivo |
| `order` | Orden en el carrusel (solo banners principales) |
| `button_link` / `button_color` | Botón de acción (opcional; el color solo aparece si hay enlace) |

> **Orden del formulario:** el bloque *Configuración* (estado, tipo, orden/página) aparece siempre **antes** que *Información del Banner*, para que el tipo quede claro antes de completar el contenido.

</details>

<details>
<summary><strong>home_cards — Tarjetas de la página de inicio (máx. 6)</strong></summary>

| Campo | Descripción |
|:---|:---|
| `title` | Título de la tarjeta (máx. 40 chars) |
| `description` | Descripción breve (máx. 200 chars) |
| `button_text` | Texto del botón (default: "Ver más") |
| `type` | `pdf` (archivo descargable) o `url` (enlace externo) |
| `file_path` | Ruta del PDF (si `type = pdf`) |
| `url` | Enlace web (si `type = url`) |
| `order` / `estado` | Orden y estado |

</details>

<details>
<summary><strong>formal_education_sections — Educación Formal (máx. 6 secciones)</strong></summary>

Secciones de contenido del módulo de Educación Formal. Pertenecen al área `educacion-comunicacion`. Existe **exactamente un registro por tipo de sección** — el campo `section` tiene restricción de unicidad.

| Campo | Descripción |
|:---|:---|
| `area_id` | FK → `areas.id` |
| `section` | Tipo de sección (ver tabla de valores abajo) |
| `title` | Título único dentro de la sección (máx. 50 chars) |
| `description` | Contenido con formato (RichEditor) |
| `image` | Ícono o imagen representativa — **obligatorio** (JPG/PNG) |
| `pdf_file` | PDF adjunto — **obligatorio** |
| `url` | Enlace externo (opcional) |
| `order` / `active` | Orden y estado |
| `created_by` / `updated_by` | Auditoría → `users.id` |

**Tipos de sección disponibles:**

| Valor | Etiqueta visible |
|:---|:---|
| `generalities` | Generalidades |
| `modalities` | Modalidades |
| `procedures` | Trámites |
| `intern_commitments` | Compromisos del Estudiante |
| `institute_commitments` | Compromisos del Instituto |
| `access_conditions` | Condiciones para Acceder |

> El filtro de la tabla permite filtrar registros por cualquiera de estos seis tipos.

</details>

<details>
<summary><strong>courses — Cursos (con Soft Delete)</strong></summary>

| Campo | Descripción |
|:---|:---|
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
| `created_by` / `updated_by` | Auditoría → `users.id` |

</details>

<details>
<summary><strong>educational_materials — Materiales Educativos</strong></summary>

| Campo | Descripción |
|:---|:---|
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
| `created_by` / `updated_by` | Auditoría → `users.id` |

</details>

<details>
<summary><strong>publications — Publicaciones académicas</strong></summary>

| Campo | Descripción |
|:---|:---|
| `area_id` | FK → `areas.id` (siempre Investigación) |
| `title` | Título único (máx. 50 chars) |
| `subtitle` | Subtítulo (opcional, máx. 100 chars) |
| `short_description` | Descripción breve (máx. 300 chars) |
| `image` | Imagen de portada |
| `external_link` | URL de la publicación externa |
| `status` | `active` o `inactive` |
| `order` | Orden de visualización |
| `created_by` / `updated_by` | Auditoría → `users.id` |

</details>

<details>
<summary><strong>research_group — Grupo de Investigación (Singleton)</strong></summary>

Solo puede existir un registro. El modelo lanza una excepción si se intenta crear un segundo.

| Campo | Descripción |
|:---|:---|
| `area_id` | FK → `areas.id` (siempre Investigación) |
| `name` | Nombre del grupo |
| `description` | Descripción completa (RichEditor) |
| `mini_description` | Descripción breve |
| `link` | Enlace externo del grupo |
| `research_line_1` | Primera línea de investigación (requerida) |
| `research_line_2` | Segunda línea de investigación (requerida) |
| `research_line_3` | Tercera línea de investigación (opcional) |
| `active` | Estado |
| `created_by` / `updated_by` | Auditoría → `users.id` |

> `total_publications` es un **accessor calculado** (sin columna en BD): cuenta las publicaciones activas del área asociada.

</details>

<details>
<summary><strong>health_promotion_categories — Categorías de Salud (máx. 4)</strong></summary>

| Campo | Descripción |
|:---|:---|
| `area_id` | FK → `areas.id` (siempre Proyección Social) |
| `category` | Clave interna: `early_childhood`, `childhood`, `women`, `workers` |
| `display_name` | Nombre visible en el sitio |
| `image` | Imagen representativa (16:9) |
| `pdf_file` | PDF general de la categoría (opcional) |
| `order` / `active` | Orden y estado |
| `created_by` / `updated_by` | Auditoría → `users.id` |

**Categorías sembradas con seeder:**

| # | Nombre | Clave |
|:---:|:---|:---|
| 1 | Primera Infancia | `early_childhood` |
| 2 | Niñez | `childhood` |
| 3 | Mujer | `women` |
| 4 | Trabajadores | `workers` |

</details>

<details>
<summary><strong>health_promotion_items — Ítems de Salud</strong></summary>

Viñetas de contenido pertenecientes a cada categoría de salud.

| Campo | Descripción |
|:---|:---|
| `category_id` | FK → `health_promotion_categories.id` |
| `title` | Título del ítem (máx. 100 chars) |
| `short_description` | Descripción breve (máx. 150 chars) |
| `order` / `active` | Orden y estado |
| `created_by` / `updated_by` | Auditoría → `users.id` |

</details>

<details>
<summary><strong>repository_categories — Categorías del Repositorio</strong></summary>

| Campo | Descripción |
|:---|:---|
| `title` | Nombre de la categoría |
| `description` | Descripción (opcional) |
| `image` | Imagen representativa |
| `order` / `status` | Orden y estado |

</details>

<details>
<summary><strong>repository_documents — Documentos del Repositorio</strong></summary>

| Campo | Descripción |
|:---|:---|
| `repository_category_id` | FK → `repository_categories.id` |
| `title` | Título del documento |
| `authors` | Autor(es) (opcional) |
| `topic` | Tema / etiqueta (opcional) |
| `description` | Descripción (opcional) |
| `image` | Imagen de portada (opcional) |
| `document` | Archivo PDF descargable (opcional) |
| `order` / `status` | Orden y estado |

</details>

<details>
<summary><strong>institutional_resources — Recursos Institucionales (Soft Delete)</strong></summary>

Un único modelo gestiona dos tipos de contenido. El orden se gestiona independientemente por tipo.

| Campo | Descripción |
|:---|:---|
| `type` | `interest_link` (Link de Interés) o `partner` (Socio/Aliado) |
| `title` | Título del link (solo `interest_link`) |
| `url` | URL del enlace (solo `interest_link`) |
| `name` | Nombre del socio/aliado (solo `partner`) |
| `image` | Logo del socio (solo `partner`) |
| `order` / `active` | Orden y estado |
| `created_by` / `updated_by` | Auditoría → `users.id` |

</details>

---

## Grupos de navegación del panel

| Grupo | Módulos incluidos |
|:---|:---|
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

Los resources implementan control de acceso granular mediante los siguientes métodos:

| Método | Permiso requerido | Efecto |
|:---|:---|:---|
| `canViewAny()` | `listXxx` | Permite ver el listado del módulo |
| `canCreate()` | `createXxx` | Permite crear nuevos registros |
| `canEdit($record)` | `editXxx` | Permite editar registros existentes |
| `canDelete($record)` | `deleteXxx` | Permite eliminar registros |
| `shouldRegisterNavigation()` | Basado en `canViewAny()` | Oculta el módulo del menú si no tiene acceso |

> El rol **`SuperAdmin`** siempre tiene acceso completo a todos los módulos sin restricciones.

---

## Seeders

Al ejecutar `php artisan migrate --seed` se crean automáticamente los datos base necesarios para que el sistema funcione:

| Seeder | Qué siembra | Dependencias |
|:---|:---|:---|
| `AreaSeeder` | Las 3 áreas organizacionales | Ninguna |
| `HealthPromotionCategorySeeder` | Las 4 categorías de salud | Requiere `AreaSeeder` (usa el área `proyeccion-social`) |

> El orden de ejecución es obligatorio: `AreaSeeder` **debe ir antes** de `HealthPromotionCategorySeeder`.

---

## Comandos útiles

| Comando | Descripción |
|:---|:---|
| `php artisan migrate` | Ejecutar migraciones pendientes |
| `php artisan migrate --seed` | Migrar y sembrar los datos base |
| `php artisan migrate:status` | Ver el estado de todas las migraciones |
| `php artisan migrate:rollback` | Revertir la última migración |
| `php artisan storage:link` | Crear enlace simbólico para archivos públicos (imágenes, PDFs) |
| `php artisan make:filament-user` | Crear un nuevo usuario del panel |
| `php artisan route:clear` | Limpiar caché de rutas |
| `php artisan config:clear` | Limpiar caché de configuración |
| `php artisan optimize:clear` | Limpiar toda la caché de la aplicación |

---

## Historial de cambios

### v1.1.0 — 2026-03-10

#### Dependencias
- Se añadió **`intervention/image ^3.11`** a `composer.json`. Esta librería es requerida para que los campos `FileUpload` con `imageResizeMode('force')` puedan redimensionar imágenes automáticamente al subirlas.

#### Banners (`BannerResource` + tabla `banners`)
- **Orden del formulario corregido:** la sección *Configuración* (estado, tipo, orden, página) ahora aparece **antes** de *Información del Banner*, lo que permite al usuario elegir el tipo de banner antes de completar su contenido.
- **Subtítulo y color del subtítulo ocultos en banners secundarios:** los campos `subtitle` y `subtitle_color` solo son visibles cuando el tipo de banner es `main`. Al cambiar a `secondary`, desaparecen del formulario.
- **Campo `order` condicional:** solo se muestra y se requiere para banners de tipo `main`. Los banners secundarios no usan campo de orden.
- **Contador de caracteres en vivo en `subtitle`:** muestra `X / 60 caracteres` en tiempo real. Cambia a color advertencia cuando quedan menos de 5 caracteres disponibles.
- **Eliminado el mínimo de caracteres** en `title` (antes requería 15 chars mínimo) y en `subtitle` (antes requería 15 chars mínimo).

#### Áreas (`AreaResource` + tabla `areas`)
- **Nombre y slug de solo lectura:** los campos `name` y `slug` del área ahora se muestran como campos deshabilitados (`->disabled()->dehydrated()`). Son visibles pero no editables, garantizando que los slugs que usa el frontend nunca cambien.
- **Campos de sub-sección visibles solo para `educacion-comunicacion`:** la sección *Descripciones — Educación y Comunicación* (con los campos de Educación Formal, No Formal y Materiales) solo aparece en el formulario cuando el área tiene el slug `educacion-comunicacion`. En las otras dos áreas esta sección se oculta completamente.
- **Imágenes de sub-sección:** los tres campos de imagen de sub-sección (`formal_education_image`, `non_formal_education_image`, `educational_materials_image`) aceptan JPG y PNG, admiten hasta 2 MB, y se redimensionan automáticamente a **1024 × 577 px** (antes eran íconos PNG de 74 × 119 px).
- **Colores de tarjeta:** se añadieron tres campos `ColorPicker` (`formal_education_color`, `non_formal_education_color`, `educational_materials_color`) para configurar el color de fondo de las tarjetas de cada sub-sección.
- **Nuevas migraciones:**
  - `2026_03_10_000008` — agrega las columnas `formal_education_image`, `non_formal_education_image`, `formal_education_color`, `non_formal_education_color`, `educational_materials_color` a la tabla `areas`.
  - `2026_03_10_000009` — renombra las columnas anteriores para que coincidan con los nombres definitivos usados en el código (corrección de inconsistencia entre migraciones).

#### Equipo (`TeamResource`)
- **Descripción eliminada del listado:** la columna `description` ya no aparece en la tabla del panel. Solo es visible al abrir el formulario de un integrante.
- **Límite de descripción aumentado:** el campo `description` ahora acepta hasta **1000 caracteres** (antes el límite era 200).

#### Educación Formal (`FormalEducationSectionResource`)
- **Nueva sección `access_conditions`:** se añadió la opción *Condiciones para Acceder* al selector de tipo de sección. Ahora existen 6 tipos posibles, uno por sección de contenido.
- **Ícono y PDF obligatorios:** los campos `image` (ícono/imagen de sección) y `pdf_file` son ahora campos requeridos. Antes eran opcionales.

---

## Licencia

Uso interno — Instituto Proinapsa.
