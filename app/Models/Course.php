<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'title',
        'course_category_id',
        'image',
        'overview',
        'duration',
        'fee',
    ];

    protected $casts = ['fee' => 'decimal:2'];

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }
}
