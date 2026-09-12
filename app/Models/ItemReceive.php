<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemReceive extends Model
{
    protected $table = 'item_receives';

    protected $fillable = [
        'item_id',
        'supplier_id',
        'item_store_id',
        'quantity',
        'date',
        'reference_no',
    ];

    protected $casts = ['date' => 'date'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function itemStore()
    {
        return $this->belongsTo(ItemStore::class, 'item_store_id');
    }
}
