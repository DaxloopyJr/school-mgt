<?php

namespace App\Http\Controllers;

use App\Models\FeesDiscount;

class FeesDiscountController extends CrudController
{
    protected string $model = FeesDiscount::class;
    protected string $route = 'fees-discounts';
    protected string $title = 'Fees Discount';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Discount Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'type', 'label' => 'Type', 'type' => 'select', 'options' => ['fixed' => 'Fixed Amount', 'percent' => 'Percentage'], 'default' => 'fixed'],
            ['name' => 'amount', 'label' => 'Amount / Percent', 'type' => 'number', 'required' => true],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
