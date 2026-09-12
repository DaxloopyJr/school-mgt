<?php

namespace App\Http\Controllers;

use App\Models\Complaint;

class ComplaintController extends CrudController
{
    protected string $model = Complaint::class;
    protected string $route = 'complaints';
    protected string $title = 'Complaint';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'complain_by', 'label' => 'Complain By', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'complaint_type', 'label' => 'Complaint Type', 'type' => 'text'],
            ['name' => 'phone', 'label' => 'Phone', 'type' => 'text'],
            ['name' => 'date', 'label' => 'Date', 'type' => 'date', 'required' => true],
            ['name' => 'source', 'label' => 'Source', 'type' => 'text'],
            ['name' => 'assigned', 'label' => 'Assigned To', 'type' => 'text'],
            ['name' => 'action_taken', 'label' => 'Action Taken', 'type' => 'text', 'list' => false],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
