<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeOfServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        $n = 0;
        $services= [
            ['id'=>++$n,'name' => 'Coahing Rédaction complète Master', 'description' => 'Redaction de documents','prix'=>60000,'time_limite'=>7,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Rédaction complète licence', 'description' => 'Redaction de documents','prix'=>40000,'time_limite'=>7,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Rédaction complète Doctorat', 'description' => 'Redaction de documents','prix'=>80000,'time_limite'=>7,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            
            ['id'=>++$n,'name' => 'Coahing Protocole Master', 'description' => 'Amélioration des document','prix'=>25000,'time_limite'=>7,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Protocole licence', 'description' => 'Amélioration des document','prix'=>15000,'time_limite'=>7,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Protocole Doctorat', 'description' => 'Amélioration des document','prix'=>35000,'time_limite'=>7,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
          
            ['id'=>++$n,'name' => 'Coahing Introduction licence', 'description' => 'Correction des document','prix'=>10000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Introduction Master', 'description' => 'Correction des document','prix'=>15000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Introduction Doctorat', 'description' => 'Correction des document','prix'=>20000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            
            ['id'=>++$n,'name' => 'Coahing Problèmatique licence', 'description' => 'Correction des document','prix'=>10000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Problèmatique Master', 'description' => 'Correction des document','prix'=>15000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Problèmatique Doctorat', 'description' => 'Correction des document','prix'=>20000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            
            ['id'=>++$n,'name' => 'Coahing Discution licence', 'description' => 'Correction des document','prix'=>40000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Discution Master', 'description' => 'Correction des document','prix'=>40000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Discution Doctorat', 'description' => 'Correction des document','prix'=>40000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            
            ['id'=>++$n,'name' => 'Coahing Révue de littérature licence', 'description' => 'Correction des document','prix'=>12000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Révue de littérature Master', 'description' => 'Correction des document','prix'=>18000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Révue de littérature Doctorat', 'description' => 'Correction des document','prix'=>24000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
           
            ['id'=>++$n,'name' => 'Coahing Méthodologie licence', 'description' => 'Correction des document','prix'=>12000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Méthodologie Master', 'description' => 'Correction des document','prix'=>18000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Méthodologie Doctorat', 'description' => 'Correction des document','prix'=>24000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
           
            ['id'=>++$n,'name' => 'Coahing Analyse de données licence', 'description' => 'Correction des document','prix'=>30000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Analyse de données Master', 'description' => 'Correction des document','prix'=>40000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
            ['id'=>++$n,'name' => 'Coahing Analyse de données Doctorat', 'description' => 'Correction des document','prix'=>80000,'time_limite'=>3,'reference'=>generateUniqueReference('TS_',12,'type_of_services','reference',true)],
       
        ];
        DB::table('type_of_services')->insert($services);
    }
}
