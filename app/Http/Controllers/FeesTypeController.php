<?php

namespace App\Http\Controllers;

use App\Models\FeesType;

class FeesTypeController extends CrudController
{
    protected string $model = FeesType::class;
    protected string $route = 'fees-types';
    protected string $title = 'Fees Type';
    protected array $with = ['feesGroup'];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Type Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'fees_group_id', 'label' => 'Fees Group', 'type' => 'select', 'options' => \App\Models\FeesGroup::class, 'optionLabel' => 'name', 'relation' => 'feesGroup.name'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
