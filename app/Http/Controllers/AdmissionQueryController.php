<?php

namespace App\Http\Controllers;

use App\Models\AdmissionQuery;

class AdmissionQueryController extends CrudController
{
    protected string $model = AdmissionQuery::class;
    protected string $route = 'admission-queries';
    protected string $title = 'Admission Query';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Student Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'phone', 'label' => 'Phone', 'type' => 'text', 'search' => true],
            ['name' => 'email', 'label' => 'Email', 'type' => 'email'],
            ['name' => 'class_applied', 'label' => 'Class Applied', 'type' => 'text'],
            ['name' => 'source', 'label' => 'Source', 'type' => 'text'],
            ['name' => 'reference', 'label' => 'Reference', 'type' => 'text'],
            ['name' => 'no_of_child', 'label' => 'Number of Children', 'type' => 'integer'],
            ['name' => 'date', 'label' => 'Query Date', 'type' => 'date', 'required' => true],
            ['name' => 'follow_up_date', 'label' => 'Next Follow Up Date', 'type' => 'date'],
            ['name' => 'assigned', 'label' => 'Assigned To', 'type' => 'text'],
            ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'required' => true, 'options' => ['pending' => 'Pending', 'follow_up' => 'Follow Up', 'converted' => 'Converted', 'rejected' => 'Rejected'], 'default' => 'pending'],
            ['name' => 'note', 'label' => 'Note', 'type' => 'textarea', 'list' => false],
    ];
}
