<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeesMaster extends Model
{
    protected $table = 'fees_masters';

    protected $fillable = [
        'fees_group_id',
        'fees_type_id',
        'class_id',
        'amount',
        'due_date',
        'description',
    ];

    protected $casts = ['amount' => 'decimal:2', 'due_date' => 'date'];

    public function feesGroup()
    {
        return $this->belongsTo(FeesGroup::class, 'fees_group_id');
    }

    public function feesType()
    {
        return $this->belongsTo(FeesType::class, 'fees_type_id');
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
