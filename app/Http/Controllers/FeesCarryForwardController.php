<?php

namespace App\Http\Controllers;

use App\Models\FeesCarryForward;

class FeesCarryForwardController extends CrudController
{
    protected string $model = FeesCarryForward::class;
    protected string $route = 'fees-carry-forwards';
    protected string $title = 'Fees Carry Forward';
    protected array $with = ['student', 'academicYear'];

    protected array $fields = [
            ['name' => 'student_id', 'label' => 'Student', 'type' => 'select', 'required' => true, 'options' => '@students', 'relation' => 'student.first_name'],
            ['name' => 'academic_year_id', 'label' => 'Academic Year', 'type' => 'select', 'options' => \App\Models\AcademicYear::class, 'optionLabel' => 'name', 'relation' => 'academicYear.name'],
            ['name' => 'amount', 'label' => 'Carry Forward Amount', 'type' => 'number', 'required' => true],
            ['name' => 'note', 'label' => 'Note', 'type' => 'textarea', 'list' => false],
    ];
}
