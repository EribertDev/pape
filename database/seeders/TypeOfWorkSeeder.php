<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeOfWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        // $workType= [
        //     ['name' => 'Mémoire', 'description' => 'Redaction de documents','reference'=>generateUniqueReference('TW_',12,'type_of_works','reference',true)],
        //     ['name' => 'Thèse', 'description' => 'Amélioration des document','reference'=>generateUniqueReference('TW_',12,'type_of_works','reference',true)],
        //     ['name' => 'Analyse de données', 'description' => 'Correction des document','reference'=>generateUniqueReference('TW_',12,'type_of_works','reference',true)],
        //     ['name' => 'Article de recherche', 'description' => 'Correction des document','reference'=>generateUniqueReference('TW_',12,'type_of_works','reference',true)],
        //     ['name' => 'Présentation', 'description' => 'Correction des document','reference'=>generateUniqueReference('TW_',12,'type_of_works','reference',true)],
        //     ['name' => 'Autre', 'description' => 'Correction des document','reference'=>generateUniqueReference('TW_',12,'type_of_works','reference',true)],
        // ];
        // DB::table('type_of_works')->insert($workType);
    }
}
