<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;

class PaymentMethodController extends CrudController
{
    protected string $model = PaymentMethod::class;
    protected string $route = 'payment-methods';
    protected string $title = 'Payment Method';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'name', 'label' => 'Method Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'list' => false],
    ];
}
