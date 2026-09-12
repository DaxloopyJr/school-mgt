<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneratedCertificate extends Model
{
    protected $table = 'generated_certificates';

    protected $fillable = ['student_id', 'student_certificate_id', 'certificate_no', 'date'];

    protected $casts = ['pinned' => 'boolean', 'submitted_at' => 'datetime', 'read_at' => 'datetime', 'logged_in_at' => 'datetime'];
}
