<?php

namespace App\Http\Controllers;

use App\Models\ExamType;

class ExamTypeController extends CrudController
{
    protected string $model = ExamType::class;
    protected string $route = 'exam-types';
    protected string $title = 'Exam Type';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Type Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'include_in_final', 'label' => 'Include in Final Mark', 'type' => 'checkbox'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
