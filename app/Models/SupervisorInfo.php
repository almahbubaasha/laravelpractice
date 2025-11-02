<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupervisorInfo extends Model
{
     protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'department',
        'short_bio',
        'img',
        'contact',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}