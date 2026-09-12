<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeesDiscount extends Model
{
    protected $table = 'fees_discounts';

    protected $fillable = [
        'name',
        'type',
        'amount',
        'description',
    ];

    protected $casts = ['amount' => 'decimal:2'];

}
