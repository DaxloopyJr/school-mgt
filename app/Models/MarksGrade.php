<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarksGrade extends Model
{
    protected $table = 'marks_grades';

    protected $fillable = [
        'name',
        'gpa',
        'percent_from',
        'percent_to',
        'description',
    ];

    protected $casts = ['gpa' => 'decimal:2'];

}
