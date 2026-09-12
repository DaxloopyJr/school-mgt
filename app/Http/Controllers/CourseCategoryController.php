<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;

class CourseCategoryController extends CrudController
{
    protected string $model = CourseCategory::class;
    protected string $route = 'course-categories';
    protected string $title = 'Course Category';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Category Name', 'type' => 'text', 'required' => true, 'search' => true],
    ];
}
