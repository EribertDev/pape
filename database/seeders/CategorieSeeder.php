<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \JsonException
     */
    public function run(): void
    {

        $categories = [
            [
                'id' => 1,
                'name' => 'Informatique',
                'description' => 'Études liées aux systèmes d\'information, développement de logiciels, et technologies émergentes.',
                'info' => json_encode([
                    'theme_count' => 52,
                    'icon_path' => 'clients/assets/images/icon/ct1.svg'
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'id' => 2,
                'name' => 'Marketing',
                'description' => 'Analyse des stratégies de marché, comportements des consommateurs et gestion de la marque.',
                'info' => json_encode([
                    'theme_count' => 48,
                    'icon_path' => 'clients/assets/images/icon/ct2.svg'
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'id' => 3,
                'name' => 'Finance',
                'description' => 'Thèmes liés à la gestion financière, investissements, et économie des entreprises.',
                'info' => json_encode([
                    'theme_count' => 37,
                    'icon_path' => 'clients/assets/images/icon/ct3.svg'
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'id' => 4,
                'name' => 'Droit',
                'description' => 'Études des lois, règlements, et leur application dans divers contextes.',
                'info' => json_encode([
                    'theme_count' => 42,
                    'icon_path' => 'clients/assets/images/icon/ct4.svg'
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'id' => 5,
                'name' => 'Sociologie',
                'description' => 'Analyse des comportements sociaux, des structures sociales et des interactions humaines.',
                'info' => json_encode([
                    'theme_count' => 39,
                    'icon_path' => 'clients/assets/images/icon/ct5.svg'
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'id' => 6,
                'name' => 'Éducation',
                'description' => 'Thèmes liés à la pédagogie, méthodologie de l\'enseignement, et politiques éducatives.',
                'info' => json_encode([
                    'theme_count' => 29,
                    'icon_path' => 'clients/assets/images/icon/ct6.svg'
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'id' => 7,
                'name' => 'Psychologie',
                'description' => 'Études sur le comportement humain, les processus mentaux et la santé mentale.',
                'info' => json_encode([
                    'theme_count' => 34,
                    'icon_path' => 'assets/images/icon/psychologie.svg'
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'id' => 8,
                'name' => 'Sciences de la santé',
                'description' => 'Thèmes relatifs à la médecine, soins infirmiers, et santé publique.',
                'info' => json_encode([
                    'theme_count' => 45,
                    'icon_path' => 'assets/images/icon/sante.svg'
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'id' => 9,
                'name' => 'Environnement',
                'description' => 'Études sur la protection de l\'environnement, la durabilité, et les impacts du changement climatique.',
                'info' => json_encode([
                    'theme_count' => 27,
                    'icon_path' => 'assets/images/icon/environnement.svg'
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'id' => 10,
                'name' => 'Gestion',
                'description' => 'Analyse des processus de gestion d\'entreprise, leadership, et gestion des ressources humaines.',
                'info' => json_encode([
                    'theme_count' => 40,
                    'icon_path' => 'assets/images/icon/gestion.svg'
                ], JSON_THROW_ON_ERROR)
            ]
        ];


        DB::table('categories')->insert($categories);
    }
}
