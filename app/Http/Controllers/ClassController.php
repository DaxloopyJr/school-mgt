<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;

class ClassController extends CrudController
{
    protected string $model = SchoolClass::class;
    protected string $route = 'classes';
    protected string $title = 'Class';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Class Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
