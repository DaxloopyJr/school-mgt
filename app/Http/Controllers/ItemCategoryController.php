<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;

class ItemCategoryController extends CrudController
{
    protected string $model = ItemCategory::class;
    protected string $route = 'item-categories';
    protected string $title = 'Item Category';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Category Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
