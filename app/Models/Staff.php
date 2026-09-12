<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staffs';

    protected $fillable = [
        'staff_no',
        'name',
        'designation',
        'department',
        'gender',
        'dob',
        'phone',
        'email',
        'joining_date',
        'salary',
        'photo',
        'address',
    ];

    protected $casts = ['dob' => 'date', 'joining_date' => 'date', 'salary' => 'decimal:2'];

}
