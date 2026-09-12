<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;

class BankAccountController extends CrudController
{
    protected string $model = BankAccount::class;
    protected string $route = 'bank-accounts';
    protected string $title = 'Bank Account';
    protected array $with = [];

    protected array $fields = [
            ['name' => 'bank_name', 'label' => 'Bank Name', 'type' => 'text', 'required' => true, 'search' => true],
            ['name' => 'account_name', 'label' => 'Account Name', 'type' => 'text'],
            ['name' => 'account_no', 'label' => 'Account No', 'type' => 'text'],
            ['name' => 'branch', 'label' => 'Branch', 'type' => 'text'],
            ['name' => 'opening_balance', 'label' => 'Opening Balance', 'type' => 'number'],
    ];
}
