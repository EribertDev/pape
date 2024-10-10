<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ThemeMemoire extends Model
{
    use HasFactory;

    protected $table = 'theme_memoires';

    /**
     * @throws \Exception
     */
    public function addNew(array $tm){
        $tm['status_id'] =Status::getIdByName('Actif');
        $tm['uuid'] = Str::uuid();
        $tm['created_at'] = date_create();
        $tm['updated_at'] = date_create();
        return DB::table($this->table)->insertGetId($tm);
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection|array
    {
        return self::with('status','discipline')->whereHas('status', function($query){
            $query->where('name', '!=', 'Supprimé');
        })->get();
    }

    public function getByUuid($uuid)
    {
        return self::with('status','discipline')
            ->where('uuid', $uuid)
            ->whereHas('status', function($query){
                $query->where('name', '!=', 'Supprimé');
            })->first();
    }

    public function updateByUuid($uuid, array $values = []): bool
    {
        return self::where('uuid', $uuid)->update($values) > 0;
    }

    //relations
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    //
    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class, 'discipline_id');
    }
    //
    public function redactor(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'redactor_id');
    }

}
