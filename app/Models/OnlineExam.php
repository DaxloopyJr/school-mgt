<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineExam extends Model
{
    protected $table = 'online_exams';

    protected $fillable = [
        'title',
        'class_id',
        'section_id',
        'subject_id',
        'date',
        'start_time',
        'end_time',
        'duration_minutes',
        'total_mark',
        'status',
    ];

    protected $casts = ['date' => 'date'];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
