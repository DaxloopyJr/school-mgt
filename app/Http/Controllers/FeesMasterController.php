<?php

namespace App\Http\Controllers;

use App\Models\FeesMaster;

class FeesMasterController extends CrudController
{
    protected string $model = FeesMaster::class;
    protected string $route = 'fees-masters';
    protected string $title = 'Fees Master';
    protected array $with = ['feesGroup', 'feesType', 'schoolClass'];

    protected array $fields = [
            ['name' => 'fees_group_id', 'label' => 'Fees Group', 'type' => 'select', 'required' => true, 'options' => \App\Models\FeesGroup::class, 'optionLabel' => 'name', 'relation' => 'feesGroup.name'],
            ['name' => 'fees_type_id', 'label' => 'Fees Type', 'type' => 'select', 'required' => true, 'options' => \App\Models\FeesType::class, 'optionLabel' => 'name', 'relation' => 'feesType.name'],
            ['name' => 'class_id', 'label' => 'Class', 'type' => 'select', 'options' => \App\Models\SchoolClass::class, 'optionLabel' => 'name', 'relation' => 'schoolClass.name'],
            ['name' => 'amount', 'label' => 'Amount', 'type' => 'number', 'required' => true],
            ['name' => 'due_date', 'label' => 'Due Date', 'type' => 'date'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
