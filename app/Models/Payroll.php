<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table = 'payrolls';

    protected $fillable = [
        'staff_id',
        'month',
        'year',
        'basic',
        'allowances',
        'deductions',
        'net_salary',
        'status',
        'payment_date',
    ];

    protected $casts = ['basic' => 'decimal:2', 'allowances' => 'decimal:2', 'deductions' => 'decimal:2', 'net_salary' => 'decimal:2', 'payment_date' => 'date'];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
