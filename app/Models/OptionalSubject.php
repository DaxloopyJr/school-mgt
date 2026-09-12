<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionalSubject extends Model
{
    protected $table = 'optional_subjects';

    protected $fillable = [
        'name',
        'class_id',
        'description',
    ];

    protected $casts = [];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
