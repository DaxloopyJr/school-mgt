<?php

namespace App\Http\Controllers;

use App\Models\StudentCategory;

class StudentCategoryController extends CrudController
{
    protected string $model = StudentCategory::class;
    protected string $route = 'student-categories';
    protected string $title = 'Student Category';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Category Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
