<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TypeOfWork extends Model
{
    use HasFactory;

    private static string $_table = 'type_of_works';

    public static function getAll(): Collection
    {
        return DB::table(self::$_table)
            ->select('id','name','reference')
            ->get();
    }

    public static function getNameAndIdByReference(string $refrence)
    {
        return DB::table(self::$_table)
            ->select('id', 'name',)
            ->where('reference', $refrence)
            ->first();
    }
}
