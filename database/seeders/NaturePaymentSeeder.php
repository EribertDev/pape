<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NaturePaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        $nature= [
            ['name' => 'Achat', 'description' => 'Redaction de documents','reference'=>generateUniqueReference('TW_',12,'type_of_works','reference',true)],
            ['name' => 'Prise contact', 'description' => 'Amélioration des document','reference'=>generateUniqueReference('TW_',12,'type_of_works','reference',true)],
            ['name' => 'Service', 'description' => 'Correction des document','reference'=>generateUniqueReference('TW_',12,'type_of_works','reference',true)],
        ];
        DB::table('nature_payments')->insert($nature);
    }
}
