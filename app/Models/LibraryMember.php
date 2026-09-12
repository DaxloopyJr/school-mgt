<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryMember extends Model
{
    protected $table = 'library_members';

    protected $fillable = [
        'member_type',
        'student_id',
        'staff_id',
        'card_no',
        'join_date',
    ];

    protected $casts = ['join_date' => 'date'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
