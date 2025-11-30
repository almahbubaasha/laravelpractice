<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QueryReply extends Model
{
    protected $fillable = ['query_id', 'teacher_id', 'reply'];
}