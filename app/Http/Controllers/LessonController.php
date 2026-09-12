<?php

namespace App\Http\Controllers;

use App\Models\Lesson;

class LessonController extends CrudController
{
    protected string $model = Lesson::class;
    protected string $route = 'lessons';
    protected string $title = 'Lesson';
    protected array $with = ['schoolClass', 'subject'];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Lesson Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'class_id', 'label' => 'Class', 'type' => 'select', 'options' => \App\Models\SchoolClass::class, 'optionLabel' => 'name', 'relation' => 'schoolClass.name'],
            ['name' => 'subject_id', 'label' => 'Subject', 'type' => 'select', 'options' => \App\Models\Subject::class, 'optionLabel' => 'name', 'relation' => 'subject.name'],
    ];
}
