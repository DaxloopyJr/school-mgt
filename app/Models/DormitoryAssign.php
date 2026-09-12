<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DormitoryAssign extends Model
{
    protected $table = 'dormitory_assigns';

    protected $fillable = [
        'dormitory_room_id',
        'student_id',
        'assigned_date',
        'status',
    ];

    protected $casts = ['assigned_date' => 'date'];

    public function dormitoryRoom()
    {
        return $this->belongsTo(DormitoryRoom::class, 'dormitory_room_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function room()
    {
        return $this->belongsTo(DormitoryRoom::class, 'dormitory_room_id');
    }
}
