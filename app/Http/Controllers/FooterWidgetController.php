<?php

namespace App\Http\Controllers;

use App\Models\FooterWidget;

class FooterWidgetController extends CrudController
{
    protected string $model = FooterWidget::class;
    protected string $route = 'footer-widgets';
    protected string $title = 'Footer Widget';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'title', 'label' => 'Widget Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'content', 'label' => 'Content', 'type' => 'textarea', 'list' => false],
            ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'integer', 'default' => 0],
    ];
}
