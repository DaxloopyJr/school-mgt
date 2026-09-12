<?php

namespace App\Http\Controllers;

use App\Models\HomeworkEvaluation;

class HomeworkEvaluationController extends CrudController
{
    protected string $model = HomeworkEvaluation::class;
    protected string $route = 'homework-evaluations';
    protected string $title = 'Homework Evaluation';
    protected array $with = ['homework', 'student'];

    protected array $fields = [
            ['name' => 'homework_id', 'label' => 'Homework', 'type' => 'select', 'required' => true, 'options' => \App\Models\Homework::class, 'optionLabel' => 'description', 'relation' => 'homework.description'],
            ['name' => 'student_id', 'label' => 'Student', 'type' => 'select', 'required' => true, 'options' => '@students', 'relation' => 'student.first_name'],
            ['name' => 'marks', 'label' => 'Obtained Marks', 'type' => 'number'],
            ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'options' => ['pending' => 'Pending', 'completed' => 'Completed', 'good' => 'Good', 'excellent' => 'Excellent', 'incomplete' => 'Incomplete'], 'default' => 'completed'],
            ['name' => 'note', 'label' => 'Note', 'type' => 'textarea', 'list' => false],
    ];
}
