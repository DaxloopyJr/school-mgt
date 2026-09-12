<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionQuery extends Model
{
    protected $table = 'admission_queries';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'class_applied',
        'source',
        'reference',
        'no_of_child',
        'date',
        'follow_up_date',
        'assigned',
        'status',
        'note',
    ];

    protected $casts = ['date' => 'date', 'follow_up_date' => 'date'];

}
