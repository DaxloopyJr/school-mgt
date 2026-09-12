<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCertificate extends Model
{
    protected $table = 'student_certificates';

    protected $fillable = [
        'name',
        'header_text',
        'body',
        'footer_text',
    ];

    protected $casts = [];

}
