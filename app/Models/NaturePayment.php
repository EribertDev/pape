<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NaturePayment extends Model
{
    use HasFactory;
    private static string $_table ='nature_payments';
    public static function getIdByName(string $name){
        $result = DB::table(self::$_table) ->select('id')
            ->where('name', $name)
            ->first();
        //$result ? $result->id : null;
        return $result?->id;
    }
}
