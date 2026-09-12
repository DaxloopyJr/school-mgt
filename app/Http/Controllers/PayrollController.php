<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends CrudController
{
    protected string $model = Payroll::class;
    protected string $route = 'payrolls';
    protected string $title = 'Payroll';
    protected array $with = ['staff'];

    protected array $fields = [
        ['name' => 'staff_id', 'label' => 'Staff', 'type' => 'select', 'options' => '@staffs', 'relation' => 'staff.name', 'required' => true],
        ['name' => 'month', 'label' => 'Month', 'type' => 'select', 'options' => ['January' => 'January', 'February' => 'February', 'March' => 'March', 'April' => 'April', 'May' => 'May', 'June' => 'June', 'July' => 'July', 'August' => 'August', 'September' => 'September', 'October' => 'October', 'November' => 'November', 'December' => 'December'], 'required' => true],
        ['name' => 'year', 'label' => 'Year', 'type' => 'integer', 'required' => true],
        ['name' => 'basic', 'label' => 'Basic Salary', 'type' => 'number', 'required' => true],
        ['name' => 'allowances', 'label' => 'Allowances', 'type' => 'number'],
        ['name' => 'deductions', 'label' => 'Deductions', 'type' => 'number'],
        ['name' => 'net_salary', 'label' => 'Net Salary', 'type' => 'number', 'required' => true],
        ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'options' => ['unpaid' => 'Unpaid', 'paid' => 'Paid'], 'default' => 'unpaid'],
        ['name' => 'payment_date', 'label' => 'Payment Date', 'type' => 'date'],
    ];

    public function report(Request $request)
    {
        $q = Payroll::with('staff');
        if ($request->month) $q->where('month', $request->month);
        if ($request->year)  $q->where('year', $request->year);
        $rows = $q->latest()->paginate(20)->withQueryString();
        return view('payroll.report', ['rows' => $rows, 'month' => $request->month, 'year' => $request->get('year', now()->year)]);
    }
}
