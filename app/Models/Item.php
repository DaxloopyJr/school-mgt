<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'name',
        'item_category_id',
        'item_store_id',
        'quantity',
        'purchase_price',
        'sale_price',
        'description',
    ];

    protected $casts = ['purchase_price' => 'decimal:2', 'sale_price' => 'decimal:2'];

    public function itemCategory()
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }

    public function itemStore()
    {
        return $this->belongsTo(ItemStore::class, 'item_store_id');
    }
}
