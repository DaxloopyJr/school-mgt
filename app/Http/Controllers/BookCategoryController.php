<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;

class BookCategoryController extends CrudController
{
    protected string $model = BookCategory::class;
    protected string $route = 'book-categories';
    protected string $title = 'Book Category';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Category Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
