<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'incomes';

    protected $fillable = [
        'title',
        'head',
        'amount',
        'date',
        'account_id',
        'payment_method_id',
        'note',
    ];

    protected $casts = ['amount' => 'decimal:2', 'date' => 'date'];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
}
