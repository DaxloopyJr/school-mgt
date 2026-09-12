<?php

namespace App\Http\Controllers;

use App\Models\OptionalSubject;

class OptionalSubjectController extends CrudController
{
    protected string $model = OptionalSubject::class;
    protected string $route = 'optional-subjects';
    protected string $title = 'Optional Subject';
    protected array $with = ['schoolClass'];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Subject Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'class_id', 'label' => 'Class', 'type' => 'select', 'options' => \App\Models\SchoolClass::class, 'optionLabel' => 'name', 'relation' => 'schoolClass.name'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
