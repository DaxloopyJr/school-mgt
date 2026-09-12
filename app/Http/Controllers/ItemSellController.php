<?php

namespace App\Http\Controllers;

use App\Models\ItemSell;

class ItemSellController extends CrudController
{
    protected string $model = ItemSell::class;
    protected string $route = 'item-sells';
    protected string $title = 'Item Sell';
    protected array $with = ['item'];

    protected array $fields = [
            ['name' => 'item_id', 'label' => 'Item', 'type' => 'select', 'required' => true, 'options' => \App\Models\Item::class, 'optionLabel' => 'name', 'relation' => 'item.name'],
            ['name' => 'buyer_name', 'label' => 'Buyer Name', 'type' => 'text', 'required' => true],
            ['name' => 'quantity', 'label' => 'Quantity', 'type' => 'integer', 'required' => true],
            ['name' => 'price', 'label' => 'Total Price', 'type' => 'number', 'required' => true],
            ['name' => 'date', 'label' => 'Sell Date', 'type' => 'date', 'required' => true],
            ['name' => 'note', 'label' => 'Note', 'type' => 'textarea', 'list' => false],
    ];
}
