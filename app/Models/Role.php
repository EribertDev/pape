<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    private static string $_table ='roles';


    public static function getAll(){
        return DB::table(self::$_table) ->select('id','name')
            ->get();
    }

    public static function getEverythingExceptWhere($color,array $value){
        return DB::table(self::$_table)->select('id','name')->whereNotIn($color,$value)->get();
    }
    public static function getIdByName(string $name){
        $result = DB::table(self::$_table) ->select('id')
            ->where('name', $name)
            ->first();
        return $result?->id;
    }

    public static function getNameById(string $id){
        $result = DB::table(self::$_table) ->select('name')
            ->where('id', $id)
            ->first();
        return $result?->name;
    }

    public function users()
    {
        return $this->hasMany(User::class, 'roles_id');
    }
}
