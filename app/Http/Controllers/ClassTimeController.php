<?php

namespace App\Http\Controllers;

use App\Models\ClassTime;

class ClassTimeController extends CrudController
{
    protected string $model = ClassTime::class;
    protected string $route = 'class-times';
    protected string $title = 'Class Time Setup';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'period', 'label' => 'Period (e.g. Period 1)', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'start_time', 'label' => 'Start Time', 'type' => 'time', 'required' => true],
            ['name' => 'end_time', 'label' => 'End Time', 'type' => 'time', 'required' => true],
    ];
}
