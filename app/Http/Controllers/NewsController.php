<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends CrudController
{
    protected string $model = News::class;
    protected string $route = 'news';
    protected string $title = 'News';
    protected array $with = ['newsCategory'];

    protected array $fields = [
            ['name' => 'title', 'label' => 'News Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'news_category_id', 'label' => 'Category', 'type' => 'select', 'options' => \App\Models\NewsCategory::class, 'optionLabel' => 'name', 'relation' => 'newsCategory.name'],
            ['name' => 'image', 'label' => 'Image', 'type' => 'file'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
            ['name' => 'publish_date', 'label' => 'Publish Date', 'type' => 'date'],
    ];
}
