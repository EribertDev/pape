<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'status_id',
        'roles_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     *
     * Ajouter un nouveau client
     * @param array $client
     * @return void
     * @throws \Exception
     */
    public function addNewClient(array $client): int
    {

        $user = self::create([
            'email' => $client["email"],
            'password' => Hash::make($client['password']),
            'roles_id'=> Role::getIdByName('Client'),
            'status_id'=>  Status::getIdByName('Actif')
        ]);

        // Envoie l'email de confirmation
        event(new Registered($user));

        $userId = $user->id;
        unset($client["email"], $client["password"]);
        $client["user_id"] = $userId;
        return (new Client())->addNew($client);
    }

    /**
     * @throws \Exception
     */
    public function addNewMember(array $member): int
    {

       // $password = $randomString ="abcd123" /*Str::random(8)*/;
        $user = self::create([
            'email' => $member["email"],
            'password' => Hash::make($member["password"]),
            'roles_id'=> $member["roles_id"],
            'status_id'=>  Status::getIdByName('Actif')
        ]);
        // Envoie l'email de confirmation
       // event(new Registered($user));
        $userId = $user->id;
        unset($member["email"], $member["password"], $member["roles_id"]);
        $member["user_id"] = $userId;
        return (new Admin())->addNew($member);
    }
    //
    public function editMember($user_id, array $member)
    {
        $user = self::find($user_id);

        // Vérifie si l'utilisateur existe
        if (!$user) {
            throw new \Exception("Utilisateur non trouvé.");
        }

        // Prépare les données à mettre à jour
        $data = [
            'email' => $member["email"],
            'roles_id' => $member["roles_id"],
            'status_id' => Status::getIdByName('Actif'),
        ];

        // Vérifie si le mot de passe existe et n'est pas vide
        if (!empty($member["password"])) {
            $data['password'] = Hash::make($member["password"]);
        }

        // Effectue la mise à jour avec Eloquent
        $user->update($data);

        // Récupère l'id_admin et supprime les clés non nécessaires
        $id_admin = $member["id_admin"];
        unset($member["email"], $member["password"], $member["roles_id"], $member["status_id"], $member["id_admin"]);

        // Met à jour les informations de l'administrateur
        return (new Admin())->edit($id_admin, $member); // Assure-toi que $member est un tableau
    }


    protected $table= "users";
    public function getUserEmailByID($id)
    {
           $email = DB::table($this->table)
            ->select('email')
            ->where('id',$id)
            ->first();
           return $email?->email;
    }

    //relation
    public function admin():HasOne
    {
        return $this->hasOne(Admin::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'roles_id'); // Assurez-vous que 'role_id' est la clé étrangère correcte
    }
}
