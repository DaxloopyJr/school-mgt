<?php

namespace App\Http\Controllers;

use App\Models\ExamAttendance;

class ExamAttendanceController extends CrudController
{
    protected string $model = ExamAttendance::class;
    protected string $route = 'exam-attendances';
    protected string $title = 'Exam Attendance';
    protected array $with = ['exam', 'student'];

    protected array $fields = [
            ['name' => 'exam_id', 'label' => 'Exam', 'type' => 'select', 'required' => true, 'options' => \App\Models\Exam::class, 'optionLabel' => 'name', 'relation' => 'exam.name'],
            ['name' => 'student_id', 'label' => 'Student', 'type' => 'select', 'required' => true, 'options' => '@students', 'relation' => 'student.first_name'],
            ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'required' => true, 'options' => ['present' => 'Present', 'absent' => 'Absent']],
    ];
}
