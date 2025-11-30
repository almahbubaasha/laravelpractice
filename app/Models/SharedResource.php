<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'student_identifier',
        'resource_name',
        'resource_link',
        'file_path',
        'file_original_name',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the teacher who shared the resource
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Get the student who received the resource
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_identifier', 'identifier');
    }
}