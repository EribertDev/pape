<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Categorie;
use App\Models\Discipline;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
           // AcademicLevelSeeder::class,
            TypeOfServiceSeeder::class,
         //   TypeOfWorkSeeder::class,
            DisciplineSeeder::class,
           // NaturePaymentSeeder::class,
            //TypeDocumentSeeder::class,
            StatusSeeder::class,
            RoleSeeder::class,
            //CategorieSeeder::class
          AdminSeeder::class,
          AffilerSeeder::class,
          ThemeMemoireSeeder::class
        ]);
    }
}