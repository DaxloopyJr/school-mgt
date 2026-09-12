<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
    protected $table = 'student_groups';

    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [];

}
