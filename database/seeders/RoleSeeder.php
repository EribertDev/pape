<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Super Admin', 'description' => 'Has all permissions in the system.'],
            ['name' => 'Administrateur', 'description' => 'Full access to the system.'],
            ['name' => 'Editeur', 'description' => 'Can edit content.'],
            ['name' => 'Client', 'description' => 'Can view content.'],
            ['name' => 'Affilier', 'description' => 'Can view content.'],
        ];

        DB::table('roles')->insert($roles);
    }
}
