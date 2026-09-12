<?php

namespace App\Http\Controllers;

use App\Models\Staff;

class StaffController extends CrudController
{
    protected string $model = Staff::class;
    protected string $route = 'staff';
    protected string $title = 'Staff';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'staff_no', 'label' => 'Staff No', 'type' => 'text', 'search' => true],
            ['name' => 'name', 'label' => 'Full Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'designation', 'label' => 'Designation', 'type' => 'text'],
            ['name' => 'department', 'label' => 'Department', 'type' => 'text'],
            ['name' => 'gender', 'label' => 'Gender', 'type' => 'select', 'list' => false, 'options' => ['male' => 'Male', 'female' => 'Female', 'other' => 'Other']],
            ['name' => 'dob', 'label' => 'Date of Birth', 'type' => 'date', 'list' => false],
            ['name' => 'phone', 'label' => 'Phone', 'type' => 'text'],
            ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'list' => false],
            ['name' => 'joining_date', 'label' => 'Joining Date', 'type' => 'date'],
            ['name' => 'salary', 'label' => 'Basic Salary', 'type' => 'number'],
            ['name' => 'photo', 'label' => 'Photo', 'type' => 'file'],
            ['name' => 'address', 'label' => 'Address', 'type' => 'textarea', 'list' => false],
    ];
}
