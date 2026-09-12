<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends CrudController
{
    protected string $model = Page::class;
    protected string $route = 'pages';
    protected string $title = 'Page';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'title', 'label' => 'Page Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'slug', 'label' => 'Slug', 'type' => 'text', 'required' => true],
            ['name' => 'content', 'label' => 'Content', 'type' => 'textarea', 'list' => false],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => 1],
    ];
}
