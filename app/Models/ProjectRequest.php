<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    use HasFactory;
      protected $fillable = [
        'user_id',
        'title',
        'problem',
        'general_objective',
        'specific_objectives',
        'beneficiaries',
        'partners',
        'budget',
        'document_path',
        'final_path',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
