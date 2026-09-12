<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $table = 'complaints';

    protected $fillable = [
        'complain_by',
        'complaint_type',
        'phone',
        'date',
        'source',
        'assigned',
        'action_taken',
        'description',
    ];

    protected $casts = ['date' => 'date'];

}
