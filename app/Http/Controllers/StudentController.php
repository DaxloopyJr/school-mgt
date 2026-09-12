<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentController extends CrudController
{
    protected string $model = Student::class;
    protected string $route = 'students';
    protected string $title = 'Student';
    protected array $with = ['schoolClass', 'section', 'category'];

    protected array $fields = [
        ['name' => 'admission_no', 'label' => 'Admission No', 'type' => 'text', 'required' => true, 'search' => true],
        ['name' => 'roll_no', 'label' => 'Roll No', 'type' => 'text', 'search' => true],
        ['name' => 'first_name', 'label' => 'First Name', 'type' => 'text', 'required' => true, 'search' => true],
        ['name' => 'last_name', 'label' => 'Last Name', 'type' => 'text', 'search' => true],
        ['name' => 'gender', 'label' => 'Gender', 'type' => 'select', 'options' => ['male' => 'Male', 'female' => 'Female', 'other' => 'Other']],
        ['name' => 'dob', 'label' => 'Date of Birth', 'type' => 'date', 'list' => false],
        ['name' => 'religion', 'label' => 'Religion', 'type' => 'text', 'list' => false],
        ['name' => 'blood_group', 'label' => 'Blood Group', 'type' => 'select', 'options' => ['A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'O+' => 'O+', 'O-' => 'O-', 'AB+' => 'AB+', 'AB-' => 'AB-'], 'list' => false],
        ['name' => 'category_id', 'label' => 'Category', 'type' => 'select', 'options' => \App\Models\StudentCategory::class, 'optionLabel' => 'name', 'relation' => 'category.name'],
        ['name' => 'class_id', 'label' => 'Class', 'type' => 'select', 'options' => \App\Models\SchoolClass::class, 'optionLabel' => 'name', 'relation' => 'schoolClass.name', 'required' => true],
        ['name' => 'section_id', 'label' => 'Section', 'type' => 'select', 'options' => \App\Models\Section::class, 'optionLabel' => 'name', 'relation' => 'section.name'],
        ['name' => 'group_id', 'label' => 'Group', 'type' => 'select', 'options' => \App\Models\StudentGroup::class, 'optionLabel' => 'name', 'relation' => 'studentGroup.name', 'list' => false],
        ['name' => 'parent_id', 'label' => 'Parent Account', 'type' => 'select', 'options' => '@parents', 'relation' => 'parent.name', 'list' => false],
        ['name' => 'user_id', 'label' => 'Student Login', 'type' => 'select', 'options' => '@student_users', 'relation' => 'user.name', 'list' => false],
        ['name' => 'transport_route_id', 'label' => 'Transport Route', 'type' => 'select', 'options' => \App\Models\TransportRoute::class, 'optionLabel' => 'title', 'relation' => 'transportRoute.title', 'list' => false],
        ['name' => 'dormitory_room_id', 'label' => 'Dormitory Room', 'type' => 'select', 'options' => \App\Models\DormitoryRoom::class, 'optionLabel' => 'name', 'relation' => 'dormitoryRoom.name', 'list' => false],
        ['name' => 'phone', 'label' => 'Phone', 'type' => 'text'],
        ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'list' => false],
        ['name' => 'address', 'label' => 'Address', 'type' => 'textarea', 'list' => false],
        ['name' => 'admission_date', 'label' => 'Admission Date', 'type' => 'date'],
        ['name' => 'photo', 'label' => 'Photo', 'type' => 'file'],
        ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'options' => ['active' => 'Active', 'disabled' => 'Disabled'], 'default' => 'active'],
    ];
}
