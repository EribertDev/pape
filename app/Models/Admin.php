<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    use HasFactory;

    /**
     * Ajouter un membre a l'equipe
     * @throws \Exception
     */
    public  function addNew(array $admin): int
    {
        $admin['reference'] = generateUniqueReference('AD_',15,'admins','reference',true);
        $admin['status_id'] =Status::getIdByName('Actif');
        $admin['created_at'] = date_create();
        $admin['updated_at'] = date_create();
        return DB::table('admins')->insertGetId($admin);
    }

    /***
     * recupration des membres
     *
     * @param $value
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public  function getAllPargination($value)
    {
       return self::with([
            'status:id,name',
            'user:id,email,roles_id', // Ajoutez role_id pour récupérer l'ID du rôle
            'user.role:id,name'
        ])->whereHas('status', function($query) {
            $query->where('name', '!=', 'supprimé');
        })->paginate($value,['id','reference', 'last_name','fist_name', 'status_id', 'user_id']);
    }
    //
    public function getAdminByUserId($id)
    {
        return DB::table('admins')->where('user_id', $id)->first();
    }
    /**
     * recuperation d'un membre par ca reference
     * @param $reference
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function getByReference($reference)
    {
        return self::with([
            'user:id,email,roles_id',
            'user.role:id,name',
            'status:id,name'
        ])->where('reference',$reference)
            ->first( ['id','last_name', 'fist_name','phone_number', 'bio', 'status_id', 'user_id']);
    }

    /**
     * Recupérer les rédacteurs dont le role est $role
     * @param $role
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllByRole($role): Collection|array
    {
        return self::with([
            'user:id,email,roles_id',
            'user.role:id,name',
            'status:id,name'
        ])
            ->whereHas('user.role', function($query) use ($role) {
                $query->where('name', $role);
            })
            ->get(['id', 'last_name', 'fist_name', 'status_id', 'user_id']);
    }

    //relations
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /*public function role()
    {
        return $this->belongsTo(Role::class);
    }*/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
