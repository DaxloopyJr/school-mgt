<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeesType extends Model
{
    protected $table = 'fees_types';

    protected $fillable = [
        'name',
        'fees_group_id',
        'description',
    ];

    protected $casts = [];

    public function feesGroup()
    {
        return $this->belongsTo(FeesGroup::class, 'fees_group_id');
    }
}
