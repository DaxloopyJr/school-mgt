<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $table = 'school_classes';

    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [];


    public function students() { return $this->hasMany(Student::class, 'class_id'); }
    public function sections() { return $this->hasMany(Section::class, 'class_id'); }
}
