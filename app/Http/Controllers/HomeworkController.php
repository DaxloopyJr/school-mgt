<?php

namespace App\Http\Controllers;

use App\Models\Homework;

class HomeworkController extends CrudController
{
    protected string $model = Homework::class;
    protected string $route = 'homeworks';
    protected string $title = 'Homework';
    protected array $with = ['schoolClass', 'section', 'subject'];

    protected array $fields = [
            ['name' => 'class_id', 'label' => 'Class', 'type' => 'select', 'required' => true, 'options' => \App\Models\SchoolClass::class, 'optionLabel' => 'name', 'relation' => 'schoolClass.name'],
            ['name' => 'section_id', 'label' => 'Section', 'type' => 'select', 'options' => \App\Models\Section::class, 'optionLabel' => 'name', 'relation' => 'section.name'],
            ['name' => 'subject_id', 'label' => 'Subject', 'type' => 'select', 'options' => \App\Models\Subject::class, 'optionLabel' => 'name', 'relation' => 'subject.name'],
            ['name' => 'homework_date', 'label' => 'Homework Date', 'type' => 'date', 'required' => true],
            ['name' => 'submission_date', 'label' => 'Submission Date', 'type' => 'date', 'required' => true],
            ['name' => 'marks', 'label' => 'Marks', 'type' => 'integer'],
            ['name' => 'file', 'label' => 'Attachment', 'type' => 'file'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'required' => true, 'search' => true, 'list' => false],
    ];

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $this->validatedData($request);
        $data['created_by'] = auth()->id();
        ($this->model)::create($data);
        return redirect()->route($this->route . '.index')->with('success', $this->title . ' created successfully.');
    }
}
