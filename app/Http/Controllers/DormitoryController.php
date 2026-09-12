<?php

namespace App\Http\Controllers;

use App\Models\Dormitory;

class DormitoryController extends CrudController
{
    protected string $model = Dormitory::class;
    protected string $route = 'dormitories';
    protected string $title = 'Dormitory';
    protected array $with = [];

    protected array $fields = [
        ['name' => 'name', 'label' => 'Dormitory Name', 'type' => 'text', 'required' => true, 'search' => true],
        ['name' => 'type', 'label' => 'Type', 'type' => 'select', 'options' => ['boys' => 'Boys', 'girls' => 'Girls', 'mixed' => 'Mixed'], 'default' => 'boys'],
        ['name' => 'address', 'label' => 'Address', 'type' => 'text', 'list' => false],
        ['name' => 'capacity', 'label' => 'Capacity', 'type' => 'integer'],
    ];
}
