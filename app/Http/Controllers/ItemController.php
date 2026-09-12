<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemController extends CrudController
{
    protected string $model = Item::class;
    protected string $route = 'items';
    protected string $title = 'Item';
    protected array $with = ['itemCategory', 'itemStore'];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Item Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'item_category_id', 'label' => 'Category', 'type' => 'select', 'options' => \App\Models\ItemCategory::class, 'optionLabel' => 'name', 'relation' => 'itemCategory.name'],
            ['name' => 'item_store_id', 'label' => 'Store', 'type' => 'select', 'options' => \App\Models\ItemStore::class, 'optionLabel' => 'name', 'relation' => 'itemStore.name'],
            ['name' => 'quantity', 'label' => 'Stock Quantity', 'type' => 'integer', 'required' => true, 'default' => 0],
            ['name' => 'purchase_price', 'label' => 'Purchase Price', 'type' => 'number'],
            ['name' => 'sale_price', 'label' => 'Sale Price', 'type' => 'number'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
