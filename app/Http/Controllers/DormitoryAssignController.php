<?php

namespace App\Http\Controllers;

use App\Models\DormitoryAssign;

class DormitoryAssignController extends CrudController
{
    protected string $model = DormitoryAssign::class;
    protected string $route = 'dormitory-assigns';
    protected string $title = 'Room Assignment';
    protected array $with = ['dormitoryRoom', 'student'];

    protected array $fields = [
            ['name' => 'dormitory_room_id', 'label' => 'Room', 'type' => 'select', 'required' => true, 'options' => \App\Models\DormitoryRoom::class, 'optionLabel' => 'name', 'relation' => 'dormitoryRoom.name'],
            ['name' => 'student_id', 'label' => 'Student', 'type' => 'select', 'required' => true, 'options' => '@students', 'relation' => 'student.first_name'],
            ['name' => 'assigned_date', 'label' => 'Assigned Date', 'type' => 'date', 'required' => true],
            ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'options' => ['active' => 'Active', 'vacated' => 'Vacated'], 'default' => 'active'],
    ];
}
