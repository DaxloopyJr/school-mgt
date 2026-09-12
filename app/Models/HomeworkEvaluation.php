<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeworkEvaluation extends Model
{
    protected $table = 'homework_evaluations';

    protected $fillable = [
        'homework_id',
        'student_id',
        'marks',
        'status',
        'note',
    ];

    protected $casts = ['marks' => 'decimal:2'];

    public function homework()
    {
        return $this->belongsTo(Homework::class, 'homework_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
