<?php

namespace App\Http\Controllers;

use App\Models\Income;

class IncomeController extends CrudController
{
    protected string $model = Income::class;
    protected string $route = 'incomes';
    protected string $title = 'Income';
    protected array $with = ['account', 'paymentMethod'];

    protected array $fields = [
            ['name' => 'title', 'label' => 'Income Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'head', 'label' => 'Income Head', 'type' => 'text'],
            ['name' => 'amount', 'label' => 'Amount', 'type' => 'number', 'required' => true],
            ['name' => 'date', 'label' => 'Date', 'type' => 'date', 'required' => true],
            ['name' => 'account_id', 'label' => 'Account', 'type' => 'select', 'options' => \App\Models\Account::class, 'optionLabel' => 'name', 'relation' => 'account.name'],
            ['name' => 'payment_method_id', 'label' => 'Payment Method', 'type' => 'select', 'options' => \App\Models\PaymentMethod::class, 'optionLabel' => 'name', 'relation' => 'paymentMethod.name'],
            ['name' => 'note', 'label' => 'Note', 'type' => 'textarea', 'list' => false],
    ];
}
