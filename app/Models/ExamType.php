<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    protected $table = 'exam_types';

    protected $fillable = [
        'name',
        'include_in_final',
        'description',
    ];

    protected $casts = ['include_in_final' => 'boolean'];

}
