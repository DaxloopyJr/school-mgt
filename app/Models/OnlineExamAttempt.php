<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineExamAttempt extends Model
{
    protected $table = 'online_exam_attempts';

    protected $fillable = ['online_exam_id', 'student_id', 'answers', 'score', 'submitted_at'];

    protected $casts = ['pinned' => 'boolean', 'submitted_at' => 'datetime', 'read_at' => 'datetime', 'logged_in_at' => 'datetime'];

    public function onlineExam() { return $this->belongsTo(OnlineExam::class, 'online_exam_id'); }
    public function student() { return $this->belongsTo(Student::class, 'student_id'); }
}
