<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ============================================================
        // ORDEN IMPORTANTE: Los seeders respetan dependencias entre tablas
        // ============================================================

        // 1. Áreas (base para casi todo el sistema)
        $this->call(AreaSeeder::class);

        // 2. Equipo (antes de asignar coordinadores a áreas)
        $this->call(TeamSeeder::class);

        // 3. Categorías de Promoción de Salud (depende de áreas)
        $this->call(HealthPromotionCategorySeeder::class);

        // 4. Empresa (singleton, independiente)
        $this->call(CompanySeeder::class);

        // 5. Valores institucionales
        $this->call(ValuesSeeder::class);

        // 6. Banners
        $this->call(BannerSeeder::class);

        // 7. Tarjetas de inicio (HomeCards)
        $this->call(HomeCardSeeder::class);

        // 8. Testimonios
        $this->call(TestimonialSeeder::class);

        // 9. Noticias
        $this->call(NewsSeeder::class);

        // 10. Repositorio: categorías primero, luego documentos
        $this->call(RepositoryCategorySeeder::class);
        $this->call(RepositoryDocumentSeeder::class);

        // 11. Secciones de educación formal (depende de áreas)
        $this->call(FormalEducationSectionSeeder::class);

        // 12. Cursos (depende de áreas)
        $this->call(CourseSeeder::class);

        // 14. Publicaciones (depende de áreas)
        $this->call(PublicationSeeder::class);

        // 15. Grupo de investigación (singleton, depende de áreas)
        $this->call(ResearchGroupSeeder::class);

        // 16. Líneas de investigación (depende de grupo de investigación)
        $this->call(ResearchLineSeeder::class);

        // 17. Ítems de promoción de salud (depende de categorías de salud)
        $this->call(HealthPromotionItemSeeder::class);

        // 18. Recursos institucionales (links de interés y aliados)
        $this->call(InstitutionalResourceSeeder::class);

        $this->command->info('');
        $this->command->info('========================================');
        $this->command->info('  Todos los seeders ejecutados con exito');
        $this->command->info('========================================');
    }
}