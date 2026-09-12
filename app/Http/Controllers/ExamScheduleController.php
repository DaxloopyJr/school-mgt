<?php

namespace App\Http\Controllers;

use App\Models\ExamSchedule;

class ExamScheduleController extends CrudController
{
    protected string $model = ExamSchedule::class;
    protected string $route = 'exam-schedules';
    protected string $title = 'Exam Schedule';
    protected array $with = ['exam', 'subject'];

    protected array $fields = [
            ['name' => 'exam_id', 'label' => 'Exam', 'type' => 'select', 'required' => true, 'options' => \App\Models\Exam::class, 'optionLabel' => 'name', 'relation' => 'exam.name'],
            ['name' => 'subject_id', 'label' => 'Subject', 'type' => 'select', 'required' => true, 'options' => \App\Models\Subject::class, 'optionLabel' => 'name', 'relation' => 'subject.name'],
            ['name' => 'date', 'label' => 'Exam Date', 'type' => 'date', 'required' => true],
            ['name' => 'start_time', 'label' => 'Start Time', 'type' => 'time'],
            ['name' => 'end_time', 'label' => 'End Time', 'type' => 'time'],
            ['name' => 'room', 'label' => 'Room', 'type' => 'text'],
    ];
}
