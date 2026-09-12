<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;

class AcademicYearController extends CrudController
{
    protected string $model = AcademicYear::class;
    protected string $route = 'academic-years';
    protected string $title = 'Academic Year';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Year (e.g. 2025-2026)', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'start_date', 'label' => 'Start Date', 'type' => 'date'],
            ['name' => 'end_date', 'label' => 'End Date', 'type' => 'date'],
            ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox'],
    ];
}
