<?php

namespace App\Http\Controllers;

use App\Models\LessonPlan;

class LessonPlanController extends CrudController
{
    protected string $model = LessonPlan::class;
    protected string $route = 'lesson-plans';
    protected string $title = 'Lesson Plan';
    protected array $with = ['lesson', 'topic', 'teacher', 'schoolClass'];

    protected array $fields = [
            ['name' => 'lesson_id', 'label' => 'Lesson', 'type' => 'select', 'required' => true, 'options' => \App\Models\Lesson::class, 'optionLabel' => 'name', 'relation' => 'lesson.name'],
            ['name' => 'topic_id', 'label' => 'Topic', 'type' => 'select', 'options' => \App\Models\Topic::class, 'optionLabel' => 'name', 'relation' => 'topic.name'],
            ['name' => 'teacher_id', 'label' => 'Teacher', 'type' => 'select', 'options' => '@teachers', 'relation' => 'teacher.name'],
            ['name' => 'class_id', 'label' => 'Class', 'type' => 'select', 'options' => \App\Models\SchoolClass::class, 'optionLabel' => 'name', 'relation' => 'schoolClass.name'],
            ['name' => 'section_id', 'label' => 'Section', 'type' => 'select', 'list' => false, 'options' => \App\Models\Section::class, 'optionLabel' => 'name', 'relation' => 'section.name'],
            ['name' => 'date', 'label' => 'Date', 'type' => 'date', 'required' => true],
            ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'options' => ['planned' => 'Planned', 'ongoing' => 'Ongoing', 'completed' => 'Completed'], 'default' => 'planned'],
            ['name' => 'note', 'label' => 'Note', 'type' => 'textarea', 'list' => false],
    ];
}
