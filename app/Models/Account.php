<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    protected $fillable = [
        'name',
        'type',
        'opening_balance',
        'note',
    ];

    protected $casts = ['opening_balance' => 'decimal:2'];

}
