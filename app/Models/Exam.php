<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
        'name',
        'exam_type_id',
        'class_id',
        'section_id',
        'start_date',
        'end_date',
        'exam_mark',
        'description',
    ];

    protected $casts = ['start_date' => 'date', 'end_date' => 'date'];

    public function examType()
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id');
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
