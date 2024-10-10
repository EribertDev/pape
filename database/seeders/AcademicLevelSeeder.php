<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {

        //
        $levels= [
            ['name' => 'Licence', 'description' => "Niveau d'étude Licence",'reference'=>generateUniqueReference('AL_',12,'academic_levels','reference',true)],
            ['name' => 'Master', 'description' =>"Niveau d'étude Master",'reference'=>generateUniqueReference('AL_',12,'academic_levels','reference',true)],
            ['name' => 'Dorctorat', 'description' => "Niveau d'étude Doctorat",'reference'=>generateUniqueReference('AL_',12,'academic_levels','reference',true)],
          //  ['name' => 'Autre', 'description' => "Autre niveau",'reference'=>generateUniqueReference('AL_',12,'academic_levels','reference',true)],
        ];
        DB::table('academic_levels')->insert($levels);
    }
}
