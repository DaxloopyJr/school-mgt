<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    protected $table = 'student_attendances';

    protected $fillable = ['student_id', 'class_id', 'section_id', 'date', 'status', 'note'];

    protected $casts = ['pinned' => 'boolean', 'submitted_at' => 'datetime', 'read_at' => 'datetime', 'logged_in_at' => 'datetime'];
}
