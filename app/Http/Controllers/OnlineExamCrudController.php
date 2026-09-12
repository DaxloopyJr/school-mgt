<?php

namespace App\Http\Controllers;

use App\Models\OnlineExam;

class OnlineExamCrudController extends CrudController
{
    protected string $model = OnlineExam::class;
    protected string $route = 'online-exams';
    protected string $title = 'Online Exam';
    protected array $with = ['schoolClass', 'subject'];

    protected array $fields = [
        ['name' => 'title', 'label' => 'Exam Title', 'type' => 'text', 'required' => true, 'search' => true],
        ['name' => 'class_id', 'label' => 'Class', 'type' => 'select', 'options' => \App\Models\SchoolClass::class, 'optionLabel' => 'name', 'relation' => 'schoolClass.name', 'required' => true],
        ['name' => 'section_id', 'label' => 'Section', 'type' => 'select', 'options' => \App\Models\Section::class, 'optionLabel' => 'name', 'relation' => 'section.name', 'list' => false],
        ['name' => 'subject_id', 'label' => 'Subject', 'type' => 'select', 'options' => \App\Models\Subject::class, 'optionLabel' => 'name', 'relation' => 'subject.name'],
        ['name' => 'date', 'label' => 'Date', 'type' => 'date', 'required' => true],
        ['name' => 'start_time', 'label' => 'Start Time', 'type' => 'time'],
        ['name' => 'end_time', 'label' => 'End Time', 'type' => 'time'],
        ['name' => 'duration_minutes', 'label' => 'Duration (minutes)', 'type' => 'integer', 'required' => true, 'default' => 30],
        ['name' => 'total_mark', 'label' => 'Total Mark', 'type' => 'integer'],
        ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'options' => ['draft' => 'Draft', 'published' => 'Published', 'closed' => 'Closed'], 'default' => 'published'],
    ];
}
