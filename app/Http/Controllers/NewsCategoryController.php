<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;

class NewsCategoryController extends CrudController
{
    protected string $model = NewsCategory::class;
    protected string $route = 'news-categories';
    protected string $title = 'News Category';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Category Name', 'type' => 'text', 'required' => true, 'search' => true],
    ];
}
