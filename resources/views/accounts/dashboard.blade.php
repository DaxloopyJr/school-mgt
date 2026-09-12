@extends('layouts.app')
@section('title', 'Account Dashboard')
@section('content')
@php $profit = $incomeTotal + $feesTotal - $expenseTotal; @endphp
<div class="row g-3 mb-3">
    <div class="col-md-3"><div class="card stat-card shadow-sm" style="border-left-color:#1cc88a"><div class="card-body">
        <div class="text-muted small text-uppercase">Income (Month)</div><div class="fs-5 fw-bold">{{ number_format($incomeMonth, 2) }}</div></div></div></div>
    <div class="col-md-3"><div class="card stat-card shadow-sm" style="border-left-color:#4e73df"><div class="card-body">
        <div class="text-muted small text-uppercase">Fees (Month)</div><div class="fs-5 fw-bold">{{ number_format($feesMonth, 2) }}</div></div></div></div>
    <div class="col-md-3"><div class="card stat-card shadow-sm" style="border-left-color:#e74a3b"><div class="card-body">
        <div class="text-muted small text-uppercase">Expense (Month)</div><div class="fs-5 fw-bold">{{ number_format($expenseMonth, 2) }}</div></div></div></div>
    <div class="col-md-3"><div class="card stat-card shadow-sm" style="border-left-color:{{ $profit >= 0 ? '#1cc88a' : '#e74a3b' }}"><div class="card-body">
        <div class="text-muted small text-uppercase">Profit (All Time)</div><div class="fs-5 fw-bold">{{ number_format($profit, 2) }}</div></div></div></div>
</div>
<div class="row g-3">
    <div class="col-md-6"><div class="table-card p-3"><h6>Recent Income</h6>
        <table class="table table-sm"><tbody>
            @forelse ($recentIncome as $i)<tr><td>{{ $i->title }}</td><td>{{ $i->date?->toDateString() }}</td><td class="text-end text-success">{{ number_format($i->amount, 2) }}</td></tr>
            @empty<tr><td class="text-muted">No income recorded.</td></tr>@endforelse
        </tbody></table></div></div>
    <div class="col-md-6"><div class="table-card p-3"><h6>Recent Expense</h6>
        <table class="table table-sm"><tbody>
            @forelse ($recentExpense as $e)<tr><td>{{ $e->title }}</td><td>{{ $e->date?->toDateString() }}</td><td class="text-end text-danger">{{ number_format($e->amount, 2) }}</td></tr>
            @empty<tr><td class="text-muted">No expense recorded.</td></tr>@endforelse
        </tbody></table></div></div>
</div>
@endsection
