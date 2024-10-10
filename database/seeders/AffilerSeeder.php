<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AffilerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $affiliers= [
            ['name' => 'Gérodo LEPONT', 'email' => 'gerodo@gmail.com','phone'=>'92929292','code'=>generateUniqueReference('',8,'affilers','code',true)],
            ['name' => 'Cyrano RENORI', 'email' => 'cyrano@gmail.com','phone'=>'90909290','code'=>generateUniqueReference('',8,'affilers','code',true)],
        ];
        DB::table('affilers')->insert($affiliers);
    }
}
