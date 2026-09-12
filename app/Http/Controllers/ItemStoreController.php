<?php

namespace App\Http\Controllers;

use App\Models\ItemStore;

class ItemStoreController extends CrudController
{
    protected string $model = ItemStore::class;
    protected string $route = 'item-stores';
    protected string $title = 'Item Store';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Store Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'location', 'label' => 'Location', 'type' => 'text'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
