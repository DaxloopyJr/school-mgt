<?php

namespace App\Http\Controllers;

use App\Models\CmsMenu;

class CmsMenuController extends CrudController
{
    protected string $model = CmsMenu::class;
    protected string $route = 'cms-menus';
    protected string $title = 'Header Menu';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'title', 'label' => 'Menu Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'url', 'label' => 'URL', 'type' => 'text', 'required' => true],
            ['name' => 'position', 'label' => 'Position', 'type' => 'select', 'options' => ['header' => 'Header', 'footer' => 'Footer'], 'default' => 'header'],
            ['name' => 'sort_order', 'label' => 'Sort Order', 'type' => 'integer', 'default' => 0],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => 1],
    ];
}
