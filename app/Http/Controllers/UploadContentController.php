<?php

namespace App\Http\Controllers;

use App\Models\UploadContent;

class UploadContentController extends CrudController
{
    protected string $model = UploadContent::class;
    protected string $route = 'upload-contents';
    protected string $title = 'Upload Content';
    protected array $with = ['schoolClass', 'subject'];

    protected array $fields = [
            ['name' => 'title', 'label' => 'Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'content_type', 'label' => 'Content Type', 'type' => 'select', 'required' => true, 'options' => ['assignment' => 'Assignment', 'study_material' => 'Study Material', 'syllabus' => 'Syllabus', 'other_download' => 'Other Download']],
            ['name' => 'class_id', 'label' => 'Class', 'type' => 'select', 'options' => \App\Models\SchoolClass::class, 'optionLabel' => 'name', 'relation' => 'schoolClass.name'],
            ['name' => 'section_id', 'label' => 'Section', 'type' => 'select', 'list' => false, 'options' => \App\Models\Section::class, 'optionLabel' => 'name', 'relation' => 'section.name'],
            ['name' => 'subject_id', 'label' => 'Subject', 'type' => 'select', 'options' => \App\Models\Subject::class, 'optionLabel' => 'name', 'relation' => 'subject.name'],
            ['name' => 'upload_date', 'label' => 'Upload Date', 'type' => 'date', 'required' => true],
            ['name' => 'file', 'label' => 'File', 'type' => 'file', 'required' => true],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $this->validatedData($request);
        $data['created_by'] = auth()->id();
        ($this->model)::create($data);
        return redirect()->route($this->route . '.index')->with('success', $this->title . ' created successfully.');
    }
}
