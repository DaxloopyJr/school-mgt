<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneCallLog extends Model
{
    protected $table = 'phone_call_logs';

    protected $fillable = [
        'name',
        'phone',
        'date',
        'call_duration',
        'call_type',
        'next_follow_up_date',
        'description',
    ];

    protected $casts = ['date' => 'date', 'next_follow_up_date' => 'date'];

}
