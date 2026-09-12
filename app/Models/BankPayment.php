<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankPayment extends Model
{
    protected $table = 'bank_payments';

    protected $fillable = [
        'student_id',
        'amount',
        'bank_name',
        'reference_no',
        'date',
        'status',
        'note',
    ];

    protected $casts = ['amount' => 'decimal:2', 'date' => 'date'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
