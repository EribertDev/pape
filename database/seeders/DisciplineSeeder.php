<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class   DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $n =  0;
        $disciplines = [
            ['id' => ++$n, 'name' => 'Médécine', 'description' => 'Étude et pratique de la médecine.', 'reference' => generateUniqueReference('TW_', 12, 'disciplines', 'reference', true)],
            ['id' => ++$n, 'name' => 'Santé Publique', 'description' => 'Promotion et protection de la santé des populations.', 'reference' => generateUniqueReference('TW_', 12, 'disciplines', 'reference', true)],
            ['id' => ++$n, 'name' => 'Nutrition', 'description' => 'Science de l’alimentation et de ses effets sur la santé.', 'reference' => generateUniqueReference('TW_', 12, 'disciplines', 'reference', true)],
            ['id' => ++$n, 'name' => 'Transport', 'description' => 'Gestion et organisation des transports de personnes et de marchandises.', 'reference' => generateUniqueReference('TW_', 12, 'disciplines', 'reference', true)],
            ['id' => ++$n, 'name' => 'Entreprenariat', 'description' => 'Création et gestion d\’entreprises innovantes.', 'reference' => generateUniqueReference('TW_', 12, 'disciplines', 'reference', true)],
            ['id' => ++$n, 'name' => 'Gestion des Projets', 'description' => 'Planification et gestion des ressources pour atteindre des objectifs spécifiques.', 'reference' => generateUniqueReference('TW_', 12, 'disciplines', 'reference', true)],
            ['id' => ++$n, 'name' => 'Paramédicale', 'description' => 'Soutien aux soins médicaux par des professionnels de santé non médecins.', 'reference' => generateUniqueReference('TW_', 12, 'disciplines', 'reference', true)],
        ];
        
        DB::table('disciplines')->insert($disciplines);
    }
}
