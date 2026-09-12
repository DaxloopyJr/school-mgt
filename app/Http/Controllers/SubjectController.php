<?php

namespace App\Http\Controllers;

use App\Models\Subject;

class SubjectController extends CrudController
{
    protected string $model = Subject::class;
    protected string $route = 'subjects';
    protected string $title = 'Subject';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Subject Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'code', 'label' => 'Subject Code', 'type' => 'text'],
            ['name' => 'type', 'label' => 'Type', 'type' => 'select', 'options' => ['theory' => 'Theory', 'practical' => 'Practical']],
    ];
}
