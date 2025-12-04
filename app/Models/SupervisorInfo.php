<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_identifier',
        'img',
        'full_name',
        'email',
        'department',
        'contact',
        'short_bio',
    ];

    /**
     * Get the user (teacher) that this supervisor info belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}