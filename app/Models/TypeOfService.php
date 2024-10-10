<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TypeOfService extends Model
{
    use HasFactory;

    protected $table = 'type_of_services';
    private static string $_table = 'type_of_services';

    public static function getAll(): Collection
    {
        return DB::table(self::$_table)
                ->select('id','name','reference','prix','time_limite')
                ->get();
    }

    public static function getNameAndIdByReference(string $refrence)
    {
        return DB::table(self::$_table)
            ->select('id', 'name',)
            ->where('reference', $refrence)
            ->first();
    }

    public static function getByReference(string $refrence){
        return DB::table(self::$_table)
            ->select('id', 'name','prix','time_limite')
            ->where('reference', $refrence)
            ->first();
    }


}
