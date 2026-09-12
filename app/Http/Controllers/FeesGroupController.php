<?php

namespace App\Http\Controllers;

use App\Models\FeesGroup;

class FeesGroupController extends CrudController
{
    protected string $model = FeesGroup::class;
    protected string $route = 'fees-groups';
    protected string $title = 'Fees Group';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Group Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
