<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemIssue extends Model
{
    protected $table = 'item_issues';

    protected $fillable = [
        'item_id',
        'issued_to',
        'quantity',
        'issue_date',
        'return_date',
        'status',
    ];

    protected $casts = ['issue_date' => 'date', 'return_date' => 'date'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
