<?php

namespace App\Http\Controllers;

use App\Models\MarksGrade;

class MarksGradeController extends CrudController
{
    protected string $model = MarksGrade::class;
    protected string $route = 'marks-grades';
    protected string $title = 'Marks Grade';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Grade (e.g. A+)', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'gpa', 'label' => 'GPA', 'type' => 'number'],
            ['name' => 'percent_from', 'label' => 'Percent From', 'type' => 'integer'],
            ['name' => 'percent_to', 'label' => 'Percent To', 'type' => 'integer'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
