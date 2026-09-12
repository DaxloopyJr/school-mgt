<?php

namespace App\Http\Controllers;

use App\Models\ClassRoutine;

class ClassRoutineController extends CrudController
{
    protected string $model = ClassRoutine::class;
    protected string $route = 'class-routines';
    protected string $title = 'Class Routine';
    protected array $with = ['schoolClass', 'section', 'subject', 'teacher', 'classRoom'];

    protected array $fields = [
            ['name' => 'class_id', 'label' => 'Class', 'type' => 'select', 'required' => true, 'options' => \App\Models\SchoolClass::class, 'optionLabel' => 'name', 'relation' => 'schoolClass.name'],
            ['name' => 'section_id', 'label' => 'Section', 'type' => 'select', 'options' => \App\Models\Section::class, 'optionLabel' => 'name', 'relation' => 'section.name'],
            ['name' => 'subject_id', 'label' => 'Subject', 'type' => 'select', 'required' => true, 'options' => \App\Models\Subject::class, 'optionLabel' => 'name', 'relation' => 'subject.name'],
            ['name' => 'teacher_id', 'label' => 'Teacher', 'type' => 'select', 'options' => '@teachers', 'relation' => 'teacher.name'],
            ['name' => 'room_id', 'label' => 'Room', 'type' => 'select', 'options' => \App\Models\ClassRoom::class, 'optionLabel' => 'name', 'relation' => 'classRoom.name'],
            ['name' => 'day', 'label' => 'Day', 'type' => 'select', 'required' => true, 'options' => ['Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday', 'Sunday' => 'Sunday']],
            ['name' => 'start_time', 'label' => 'Start Time', 'type' => 'time', 'required' => true],
            ['name' => 'end_time', 'label' => 'End Time', 'type' => 'time', 'required' => true],
    ];
}
