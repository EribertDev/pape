<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categorie extends Model
{
    use HasFactory;

    private static string $_table ='categories';
    public static function getIdByName(string $name){
        $result = DB::table(self::$_table) ->select('id')
            ->where('name', $name)
            ->first();
        //$result ? $result->id : null;
        return $result?->id;
    }
    //
    public static function getAll(){
        return DB::table(self::$_table) ->select('id','name')->get();
    }
    //
    public static function getAllSelectField(array $field): \Illuminate\Support\Collection
    {
        return DB::table(self::$_table) ->select($field)->get();
    }
    //

    public static function getNameById(string $id){
        $result = DB::table(self::$_table) ->select('name')
            ->where('id', $id)
            ->first();
        return $result?->name;
    }

}