<?php

namespace App\Http\Controllers;

use App\Models\Holiday;

class HolidayController extends CrudController
{
    protected string $model = Holiday::class;
    protected string $route = 'holidays';
    protected string $title = 'Holiday';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'title', 'label' => 'Holiday Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'from_date', 'label' => 'From Date', 'type' => 'date', 'required' => true],
            ['name' => 'to_date', 'label' => 'To Date', 'type' => 'date', 'required' => true],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
