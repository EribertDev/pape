<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'university',
        'domaine',
        'level',
        'specialite', 
        'duration',
        'commune',
        'structure',
        'services',
        'admin_culture_training',
        'status',
        'recommendation_letter_path',
        'binome',
        'contract_path',
        'signed_contract_path',
        'message',
        'authorization_path',
        'cip',
        'letterPath'
    ];

    protected $casts = [
        'services' => 'array',
        'admin_culture_training' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static $statuses = [
    'pending' => 'En attente',
    'pending_signature' => 'En attente de signature',
    'under_review' => 'En cours de vérification',
    'approved' => 'Approuvé',
    'rejected' => 'Rejeté',
    'completed' => 'Terminé'
];

public function getStatusNameAttribute()
{
    return self::$statuses[$this->status] ?? $this->status;
}
}
