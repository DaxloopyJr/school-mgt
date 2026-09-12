<?php

namespace App\Http\Controllers;

use App\Models\StudentGroup;

class StudentGroupController extends CrudController
{
    protected string $model = StudentGroup::class;
    protected string $route = 'student-groups';
    protected string $title = 'Student Group';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Group Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
