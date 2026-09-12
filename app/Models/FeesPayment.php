<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeesPayment extends Model
{
    protected $table = 'fees_payments';

    protected $fillable = ['invoice_no', 'student_id', 'fees_master_id', 'amount', 'discount_amount', 'fine', 'payment_date', 'method', 'note', 'received_by'];

    protected $casts = ['pinned' => 'boolean', 'submitted_at' => 'datetime', 'read_at' => 'datetime', 'logged_in_at' => 'datetime'];

    public function student() { return $this->belongsTo(Student::class, 'student_id'); }
    public function feesMaster() { return $this->belongsTo(FeesMaster::class, 'fees_master_id'); }
    public function receivedBy() { return $this->belongsTo(User::class, 'received_by'); }
}
