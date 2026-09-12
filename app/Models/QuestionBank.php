<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    protected $table = 'question_banks';

    protected $fillable = [
        'question',
        'type',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
        'mark',
        'class_id',
        'subject_id',
    ];

    protected $casts = [];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
