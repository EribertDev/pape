<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AcademicLevel extends Model
{
    use HasFactory;

    public static function getAll(): Collection
    {
        return DB::table('academic_levels')
            ->select('id','name','reference')
            ->get();
    }

    public static function getNameAndIdByReference(string $refrence)
    {
        return DB::table('academic_levels')
            ->select('id', 'name',)
            ->where('reference', $refrence)
            ->first();
    }
}
