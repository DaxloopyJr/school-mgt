<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadContent extends Model
{
    protected $table = 'upload_contents';

    protected $fillable = [
        'title',
        'content_type',
        'class_id',
        'section_id',
        'subject_id',
        'upload_date',
        'file',
        'description',
    ];

    protected $casts = ['upload_date' => 'date'];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
