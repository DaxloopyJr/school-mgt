<?php

namespace App\Http\Controllers;

use App\Models\QuestionBank;

class QuestionBankController extends CrudController
{
    protected string $model = QuestionBank::class;
    protected string $route = 'question-banks';
    protected string $title = 'Question Bank';
    protected array $with = ['schoolClass', 'subject'];

    protected array $fields = [
            ['name' => 'question', 'label' => 'Question', 'type' => 'textarea', 'required' => true, 'search' => true],
            ['name' => 'type', 'label' => 'Question Type', 'type' => 'select', 'required' => true, 'options' => ['mcq' => 'Multiple Choice', 'true_false' => 'True / False', 'fill_blank' => 'Fill in the Blank']],
            ['name' => 'option_a', 'label' => 'Option A', 'type' => 'text', 'list' => false],
            ['name' => 'option_b', 'label' => 'Option B', 'type' => 'text', 'list' => false],
            ['name' => 'option_c', 'label' => 'Option C', 'type' => 'text', 'list' => false],
            ['name' => 'option_d', 'label' => 'Option D', 'type' => 'text', 'list' => false],
            ['name' => 'correct_answer', 'label' => 'Correct Answer', 'type' => 'text', 'required' => true, 'list' => false, 'hint' => 'For MCQ enter A/B/C/D; for True-False enter true/false'],
            ['name' => 'mark', 'label' => 'Mark', 'type' => 'integer', 'required' => true, 'default' => 1],
            ['name' => 'class_id', 'label' => 'Class', 'type' => 'select', 'options' => \App\Models\SchoolClass::class, 'optionLabel' => 'name', 'relation' => 'schoolClass.name'],
            ['name' => 'subject_id', 'label' => 'Subject', 'type' => 'select', 'options' => \App\Models\Subject::class, 'optionLabel' => 'name', 'relation' => 'subject.name'],
    ];
}
