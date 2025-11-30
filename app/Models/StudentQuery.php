<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentQuery extends Model
{
    protected $fillable = ['student_id', 'teacher_id', 'query'];
    
    public function reply()
    {
        return $this->hasOne(QueryReply::class, 'query_id');
    }
}