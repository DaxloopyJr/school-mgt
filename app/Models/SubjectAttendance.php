<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectAttendance extends Model
{
    protected $table = 'subject_attendances';

    protected $fillable = ['student_id', 'class_id', 'section_id', 'subject_id', 'date', 'status'];

    protected $casts = ['pinned' => 'boolean', 'submitted_at' => 'datetime', 'read_at' => 'datetime', 'logged_in_at' => 'datetime'];
}
