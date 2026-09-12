<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeesCarryForward extends Model
{
    protected $table = 'fees_carry_forwards';

    protected $fillable = [
        'student_id',
        'academic_year_id',
        'amount',
        'note',
    ];

    protected $casts = ['amount' => 'decimal:2'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }
}
