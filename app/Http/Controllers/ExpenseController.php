<?php

namespace App\Http\Controllers;

use App\Models\Expense;

class ExpenseController extends CrudController
{
    protected string $model = Expense::class;
    protected string $route = 'expenses';
    protected string $title = 'Expense';
    protected array $with = ['account', 'paymentMethod'];

    protected array $fields = [
            ['name' => 'title', 'label' => 'Expense Title', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'head', 'label' => 'Expense Head', 'type' => 'text'],
            ['name' => 'amount', 'label' => 'Amount', 'type' => 'number', 'required' => true],
            ['name' => 'date', 'label' => 'Date', 'type' => 'date', 'required' => true],
            ['name' => 'account_id', 'label' => 'Account', 'type' => 'select', 'options' => \App\Models\Account::class, 'optionLabel' => 'name', 'relation' => 'account.name'],
            ['name' => 'payment_method_id', 'label' => 'Payment Method', 'type' => 'select', 'options' => \App\Models\PaymentMethod::class, 'optionLabel' => 'name', 'relation' => 'paymentMethod.name'],
            ['name' => 'note', 'label' => 'Note', 'type' => 'textarea', 'list' => false],
    ];
}
