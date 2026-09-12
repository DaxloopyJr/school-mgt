<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    protected $table = 'homeworks';

    protected $fillable = [
        'class_id',
        'section_id',
        'subject_id',
        'homework_date',
        'submission_date',
        'marks',
        'file',
        'description',
    ];

    protected $casts = ['homework_date' => 'date', 'submission_date' => 'date'];

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
