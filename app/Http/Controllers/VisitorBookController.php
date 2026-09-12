<?php

namespace App\Http\Controllers;

use App\Models\VisitorBook;

class VisitorBookController extends CrudController
{
    protected string $model = VisitorBook::class;
    protected string $route = 'visitor-books';
    protected string $title = 'Visitor Book';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'purpose', 'label' => 'Purpose', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'name', 'label' => 'Visitor Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'phone', 'label' => 'Phone', 'type' => 'text'],
            ['name' => 'no_of_persons', 'label' => 'No. of Persons', 'type' => 'integer'],
            ['name' => 'date', 'label' => 'Date', 'type' => 'date', 'required' => true],
            ['name' => 'in_time', 'label' => 'In Time', 'type' => 'time'],
            ['name' => 'out_time', 'label' => 'Out Time', 'type' => 'time'],
            ['name' => 'note', 'label' => 'Note', 'type' => 'textarea', 'list' => false],
    ];
}
