<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ThemeMemoireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
       
        $tms = [
            [
                'title' => 'Analyse de l\'importance des biomarqueurs prédictifs dans le diagnostic précoce de la maladie d\'Alzheimer',
                'status_id' => Status::getIdByName('Actif'),
                'uuid' => Str::uuid(),
                'created_at' => date_create(),
                'updated_at' => date_create(),
                'path' => json_encode([
                    "licence" => "",
                    "master" => "",
                    "doctorat" => "",
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'title' => 'Chirurgie réfractive pour l\'hypermétropie : techniques LASIK et autres procédures',
                'uuid' => Str::uuid(),
                'status_id' => Status::getIdByName('Actif'),
                'created_at' => date_create(),
                'updated_at' => date_create(),
                'path' => json_encode([
                    "licence" => "",
                    "master" => "",
                    "doctorat" => "",
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'title' => 'Rôle des verres progressifs et des lentilles bifocales dans la gestion de l\'hypermétropie',
                'uuid' => Str::uuid(),
                'status_id' => Status::getIdByName('Actif'),
                'created_at' => date_create(),
                'updated_at' => date_create(),
                'path' => json_encode([
                    "licence" => "",
                    "master" => "",
                    "doctorat" => "",
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'Stratégies d\'adaptation pour les personnes atteintes d\'hypermétropie dans leur vie quotidienne',
                'status_id' => Status::getIdByName('Actif'),
                'created_at' => date_create(),
                'updated_at' => date_create(),
                'path' => json_encode([
                    "licence" => "",
                    "master" => "",
                    "doctorat" => "",
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'Prévention de l\'hypermétropie : recommandations sur l\'hygiène visuelle et l\'éducation',
                'status_id' => Status::getIdByName('Actif'),
                'created_at' => date_create(),
                'updated_at' => date_create(),
                'path' => json_encode([
                    "licence" => "",
                    "master" => "",
                    "doctorat" => "",
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'Impact des écrans numériques sur le développement de l\'hypermétropie et recommandations d\'utilisation',
                'status_id' => Status::getIdByName('Actif'),
                'created_at' => date_create(),
                'updated_at' => date_create(),
                'path' => json_encode([
                    "licence" => "",
                    "master" => "",
                    "doctorat" => "",
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'Innovations dans les lentilles et les technologies de correction de l\'hypermétropie : recherche et développement',
                'status_id' => Status::getIdByName('Actif'),
                'created_at' => date_create(),
                'updated_at' => date_create(),
                'path' => json_encode([
                    "licence" => "",
                    "master" => "",
                    "doctorat" => "",
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'Études récentes sur l\'hypermétropie : tendances et nouvelles approches thérapeutiques',
                'status_id' => Status::getIdByName('Actif'),
                'created_at' => date_create(),
                'updated_at' => date_create(),
                'path' => json_encode([
                    "licence" => "",
                    "master" => "",
                    "doctorat" => "",
                ], JSON_THROW_ON_ERROR)
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'Rôle de l\'éducation visuelle dans la sensibilisation à l\'hypermétropie',
                'status_id' => Status::getIdByName('Actif'),
                'created_at' => date_create(),
                'updated_at' => date_create(),
                'path' => json_encode([
                    "licence" => "",
                    "master" => "",
                    "doctorat" => "",
                ], JSON_THROW_ON_ERROR)
            ],
        ];
        
        DB::table('theme_memoires')->insert($tms);
    }
}
