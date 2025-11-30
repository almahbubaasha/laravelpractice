<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
        'identifier',
        'role',
        'avatar',
        'department',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * ============= RELATIONS =============
     * Each student has one SupervisorInfo record
     */
    public function supervisorInfo()
    {
        return $this->hasOne(SupervisorInfo::class, 'user_id');
    }

    /**
     * A teacher can have many students (TeacherStudent table)
     */
    public function assignedStudents()
    {
        return $this->hasMany(TeacherStudent::class, 'teacher_id');
    }

    /**
     * ============= RESOURCE SHARING RELATIONS =============
     * Teacher: Resources that this teacher has shared
     */
    public function sharedResources()
    {
        return $this->hasMany(SharedResource::class, 'teacher_id');
    }

    /**
     * Student: Resources that have been shared with this student
     */
    public function receivedResources()
    {
        return $this->belongsToMany(
            SharedResource::class, 
            'resource_recipients', 
            'student_id', 
            'shared_resource_id'
        )->withTimestamps();
    }
}