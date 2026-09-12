<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_accounts';

    protected $fillable = [
        'bank_name',
        'account_name',
        'account_no',
        'branch',
        'opening_balance',
    ];

    protected $casts = ['opening_balance' => 'decimal:2'];

}
