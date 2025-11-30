<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

   protected $fillable = [
    'teacher_id',
    'title',
    'description',
    'deadline',
    'file_path',
    'file_original_name',  // এই line add করুন
];


    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function assignments()
    {
        return $this->hasMany(TaskAssignment::class);
    }
}