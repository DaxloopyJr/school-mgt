<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarkRegister extends Model
{
    protected $table = 'mark_registers';

    protected $fillable = ['exam_id', 'student_id', 'subject_id', 'marks', 'grade'];

    protected $casts = ['pinned' => 'boolean', 'submitted_at' => 'datetime', 'read_at' => 'datetime', 'logged_in_at' => 'datetime'];

    public function exam() { return $this->belongsTo(Exam::class, 'exam_id'); }
    public function student() { return $this->belongsTo(Student::class, 'student_id'); }
    public function subject() { return $this->belongsTo(Subject::class, 'subject_id'); }
}
