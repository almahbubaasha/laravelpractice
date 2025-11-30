<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherStudent extends Model
{
    use HasFactory;

    protected $table = 'teacher_students';
    protected $fillable = ['teacher_id', 'student_id'];

    /**
     * ============= RELATIONSHIPS =============
     * Get the student user (for name, identifier, etc.)
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    /**
     * Get the teacher user
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }
}