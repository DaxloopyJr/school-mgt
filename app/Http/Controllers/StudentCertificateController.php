<?php

namespace App\Http\Controllers;

use App\Models\StudentCertificate;

class StudentCertificateController extends CrudController
{
    protected string $model = StudentCertificate::class;
    protected string $route = 'student-certificates';
    protected string $title = 'Student Certificate';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Certificate Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'header_text', 'label' => 'Header Text', 'type' => 'text'],
            ['name' => 'body', 'label' => 'Certificate Body', 'type' => 'textarea', 'required' => true, 'list' => false, 'hint' => 'Use {student_name}, {class}, {date} placeholders'],
            ['name' => 'footer_text', 'label' => 'Footer Text', 'type' => 'text'],
    ];
}
