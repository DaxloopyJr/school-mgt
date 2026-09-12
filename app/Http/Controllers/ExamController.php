<?php

namespace App\Http\Controllers;

use App\Models\Exam;

class ExamController extends CrudController
{
    protected string $model = Exam::class;
    protected string $route = 'exams';
    protected string $title = 'Exam Setup';
    protected array $with = ['examType', 'schoolClass', 'section'];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Exam Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'exam_type_id', 'label' => 'Exam Type', 'type' => 'select', 'required' => true, 'options' => \App\Models\ExamType::class, 'optionLabel' => 'name', 'relation' => 'examType.name'],
            ['name' => 'class_id', 'label' => 'Class', 'type' => 'select', 'required' => true, 'options' => \App\Models\SchoolClass::class, 'optionLabel' => 'name', 'relation' => 'schoolClass.name'],
            ['name' => 'section_id', 'label' => 'Section', 'type' => 'select', 'options' => \App\Models\Section::class, 'optionLabel' => 'name', 'relation' => 'section.name'],
            ['name' => 'start_date', 'label' => 'Start Date', 'type' => 'date'],
            ['name' => 'end_date', 'label' => 'End Date', 'type' => 'date'],
            ['name' => 'exam_mark', 'label' => 'Full Mark', 'type' => 'integer', 'required' => true, 'default' => 100],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
