<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSell extends Model
{
    protected $table = 'item_sells';

    protected $fillable = [
        'item_id',
        'buyer_name',
        'quantity',
        'price',
        'date',
        'note',
    ];

    protected $casts = ['price' => 'decimal:2', 'date' => 'date'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
