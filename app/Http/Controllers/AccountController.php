<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\FeesPayment;
use App\Models\Income;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function dashboard()
    {
        $month = now()->month;
        $year = now()->year;

        return view('accounts.dashboard', [
            'incomeMonth'   => Income::whereMonth('date', $month)->whereYear('date', $year)->sum('amount'),
            'expenseMonth'  => Expense::whereMonth('date', $month)->whereYear('date', $year)->sum('amount'),
            'feesMonth'     => FeesPayment::whereMonth('payment_date', $month)->whereYear('payment_date', $year)->sum('amount'),
            'incomeTotal'   => Income::sum('amount'),
            'expenseTotal'  => Expense::sum('amount'),
            'feesTotal'     => FeesPayment::sum('amount'),
            'recentIncome'  => Income::latest('date')->take(5)->get(),
            'recentExpense' => Expense::latest('date')->take(5)->get(),
        ]);
    }

    public function paymentHistory(Request $request)
    {
        $fees = FeesPayment::with('student')->latest('payment_date')->take(50)->get()
            ->map(fn ($p) => ['date' => $p->payment_date, 'type' => 'Fees Collection', 'title' => ($p->student->fullName() ?? 'Student') . ' - ' . $p->invoice_no, 'amount' => $p->amount, 'direction' => 'in']);
        $incomes = Income::latest('date')->take(50)->get()
            ->map(fn ($i) => ['date' => $i->date, 'type' => 'Income', 'title' => $i->title, 'amount' => $i->amount, 'direction' => 'in']);
        $expenses = Expense::latest('date')->take(50)->get()
            ->map(fn ($e) => ['date' => $e->date, 'type' => 'Expense', 'title' => $e->title, 'amount' => $e->amount, 'direction' => 'out']);

        $history = $fees->concat($incomes)->concat($expenses)->sortByDesc('date')->values()->take(100);

        return view('accounts.payment-history', ['history' => $history]);
    }
}
