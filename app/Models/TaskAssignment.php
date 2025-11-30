<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'student_identifier',  // Only this, no student_id
        'reply',
        'submission_file',
        'reply_file_original_name',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    // Relationship with Task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Custom accessor for student (since we don't have student_id foreign key)
    public function getStudentAttribute()
    {
        return User::where('identifier', $this->student_identifier)
            ->orWhere('user_id', $this->student_identifier)
            ->first();
    }
}