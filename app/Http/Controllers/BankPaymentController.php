<?php

namespace App\Http\Controllers;

use App\Models\BankPayment;

class BankPaymentController extends CrudController
{
    protected string $model = BankPayment::class;
    protected string $route = 'bank-payments';
    protected string $title = 'Bank Payment';
    protected array $with = ['student'];

    protected array $fields = [
            ['name' => 'student_id', 'label' => 'Student', 'type' => 'select', 'required' => true, 'options' => '@students', 'relation' => 'student.first_name'],
            ['name' => 'amount', 'label' => 'Amount', 'type' => 'number', 'required' => true],
            ['name' => 'bank_name', 'label' => 'Bank Name', 'type' => 'text'],
            ['name' => 'reference_no', 'label' => 'Reference No', 'type' => 'text'],
            ['name' => 'date', 'label' => 'Payment Date', 'type' => 'date', 'required' => true],
            ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'options' => ['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'], 'default' => 'pending'],
            ['name' => 'note', 'label' => 'Note', 'type' => 'textarea', 'list' => false],
    ];
}
