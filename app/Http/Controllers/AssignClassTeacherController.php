<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;

class AssignClassTeacherController extends CrudController
{
    protected string $model = AssignClassTeacher::class;
    protected string $route = 'assign-class-teachers';
    protected string $title = 'Assign Class Teacher';
    protected array $with = ['schoolClass', 'section', 'teacher'];

    protected array $fields = [
            ['name' => 'class_id', 'label' => 'Class', 'type' => 'select', 'required' => true, 'options' => \App\Models\SchoolClass::class, 'optionLabel' => 'name', 'relation' => 'schoolClass.name'],
            ['name' => 'section_id', 'label' => 'Section', 'type' => 'select', 'required' => true, 'options' => \App\Models\Section::class, 'optionLabel' => 'name', 'relation' => 'section.name'],
            ['name' => 'teacher_id', 'label' => 'Class Teacher', 'type' => 'select', 'required' => true, 'options' => '@teachers', 'relation' => 'teacher.name'],
    ];
}
