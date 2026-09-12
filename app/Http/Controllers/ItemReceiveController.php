<?php

namespace App\Http\Controllers;

use App\Models\ItemReceive;

class ItemReceiveController extends CrudController
{
    protected string $model = ItemReceive::class;
    protected string $route = 'item-receives';
    protected string $title = 'Item Receive';
    protected array $with = ['item', 'supplier', 'itemStore'];

    protected array $fields = [
            ['name' => 'item_id', 'label' => 'Item', 'type' => 'select', 'required' => true, 'options' => \App\Models\Item::class, 'optionLabel' => 'name', 'relation' => 'item.name'],
            ['name' => 'supplier_id', 'label' => 'Supplier', 'type' => 'select', 'options' => \App\Models\Supplier::class, 'optionLabel' => 'name', 'relation' => 'supplier.name'],
            ['name' => 'item_store_id', 'label' => 'Store', 'type' => 'select', 'options' => \App\Models\ItemStore::class, 'optionLabel' => 'name', 'relation' => 'itemStore.name'],
            ['name' => 'quantity', 'label' => 'Quantity', 'type' => 'integer', 'required' => true],
            ['name' => 'date', 'label' => 'Receive Date', 'type' => 'date', 'required' => true],
            ['name' => 'reference_no', 'label' => 'Reference No', 'type' => 'text'],
    ];
}
