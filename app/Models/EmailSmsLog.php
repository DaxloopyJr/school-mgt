<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailSmsLog extends Model
{
    protected $table = 'email_sms_logs';

    protected $fillable = [
        'title',
        'type',
        'target',
        'message',
        'send_date',
    ];

    protected $casts = ['send_date' => 'date'];

}
