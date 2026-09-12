<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends CrudController
{
    protected string $model = Course::class;
    protected string $route = 'courses';
    protected string $title = 'Course';
    protected array $with = ['courseCategory'];

    protected array $fields = [
            ['name' => 'title', 'label' => 'Course Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'course_category_id', 'label' => 'Category', 'type' => 'select', 'options' => \App\Models\CourseCategory::class, 'optionLabel' => 'name', 'relation' => 'courseCategory.name'],
            ['name' => 'image', 'label' => 'Image', 'type' => 'file'],
            ['name' => 'overview', 'label' => 'Overview', 'type' => 'textarea', 'list' => false],
            ['name' => 'duration', 'label' => 'Duration', 'type' => 'text'],
            ['name' => 'fee', 'label' => 'Fee', 'type' => 'number'],
    ];
}
