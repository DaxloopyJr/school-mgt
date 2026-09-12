<?php

namespace App\Http\Controllers;

use App\Models\LibraryMember;

class LibraryMemberController extends CrudController
{
    protected string $model = LibraryMember::class;
    protected string $route = 'library-members';
    protected string $title = 'Library Member';
    protected array $with = ['student', 'staff'];

    protected array $fields = [
            ['name' => 'member_type', 'label' => 'Member Type', 'type' => 'select', 'required' => true, 'options' => ['student' => 'Student', 'staff' => 'Staff']],
            ['name' => 'student_id', 'label' => 'Student', 'type' => 'select', 'options' => '@students', 'relation' => 'student.first_name'],
            ['name' => 'staff_id', 'label' => 'Staff', 'type' => 'select', 'options' => '@staffs', 'relation' => 'staff.name'],
            ['name' => 'card_no', 'label' => 'Library Card No', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'join_date', 'label' => 'Join Date', 'type' => 'date'],
    ];
}
