<?php

namespace App\Http\Controllers;

use App\Models\AssignSubject;

class AssignSubjectController extends CrudController
{
    protected string $model = AssignSubject::class;
    protected string $route = 'assign-subjects';
    protected string $title = 'Assign Subject';
    protected array $with = ['schoolClass', 'section', 'subject', 'teacher'];

    protected array $fields = [
            ['name' => 'class_id', 'label' => 'Class', 'type' => 'select', 'required' => true, 'options' => \App\Models\SchoolClass::class, 'optionLabel' => 'name', 'relation' => 'schoolClass.name'],
            ['name' => 'section_id', 'label' => 'Section', 'type' => 'select', 'options' => \App\Models\Section::class, 'optionLabel' => 'name', 'relation' => 'section.name'],
            ['name' => 'subject_id', 'label' => 'Subject', 'type' => 'select', 'required' => true, 'options' => \App\Models\Subject::class, 'optionLabel' => 'name', 'relation' => 'subject.name'],
            ['name' => 'teacher_id', 'label' => 'Teacher', 'type' => 'select', 'options' => '@teachers', 'relation' => 'teacher.name'],
    ];
}
