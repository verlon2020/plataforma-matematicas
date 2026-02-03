<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'module',
        'exercise',
        'score',
        'data',
    ];

    // 🔹 Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
