<?php
 namespace App\Models;

 
use Illuminate\Database\Eloquent\Model;


class UserDocument extends Model
{
    protected $fillable = [
        'user_id', 'type','is_global', 'title', 'content', 'path', 'original_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('is_global', true)
            ->orWhere('user_id', $userId);
    }
}