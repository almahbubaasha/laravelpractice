<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 

// class Profile extends Model
// {
//     protected $fillable = [
//     'user_id',
//     'img',
//     'full_name',
//     'email',
//     'department',
//     'short_bio',
// ];


//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }
// }


class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'department',
        'short_bio',
        'img',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}