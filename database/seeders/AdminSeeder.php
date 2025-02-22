<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id=DB::table('users')->insertGetId([
            'email'=>'admin@cesiebenin.com',
            'password'=>Hash::make('pape@2024'),
            'email_verified_at'=>now(),
            'status_id'=>Status::getIdByName('Actif'),
            'roles_id'=>Role::getIdByName('Administrateur')]);
        (new Admin())->addNew(
            [
                'fist_name'=>'Admin',
                'last_name'=>'CESIE',
                'user_id'=>$id
            ]
        );
    }
}
