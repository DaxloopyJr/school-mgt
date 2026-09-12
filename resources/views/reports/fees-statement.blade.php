@extends('layouts.app')
@section('title', 'Fees Statement')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4"><label class="form-label small">Student (admission no / name)</label>
            <input type="text" name="search" value="{{ $search }}" class="form-control form-control-sm" required></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Search</button></div>
    </form>
</div>
@if ($student)
<div class="table-card p-3">
    <div class="d-flex justify-content-between">
        <h6>{{ $student->fullName() }} ({{ $student->admission_no }})</h6>
        <button class="btn btn-sm btn-outline-secondary" onclick="window.print()"><i class="bi bi-printer"></i> Print</button>
    </div>
    <div class="row small mb-3">
        <div class="col-md-4">Total Payable: <strong>{{ number_format($student->totalPayable(), 2) }}</strong></div>
        <div class="col-md-4">Total Paid: <strong class="text-success">{{ number_format($student->totalPaid(), 2) }}</strong></div>
        <div class="col-md-4">Balance: <strong class="text-danger">{{ number_format($student->balance(), 2) }}</strong></div>
    </div>
    <table class="table table-sm table-bordered">
        <thead class="table-light"><tr><th>Invoice</th><th>Fee Type</th><th class="text-end">Amount</th><th>Method</th><th>Date</th></tr></thead>
        <tbody>
            @forelse ($payments as $p)
                <tr><td>{{ $p->invoice_no }}</td><td>{{ $p->feesMaster->feesType->name ?? '-' }}</td>
                    <td class="text-end">{{ number_format($p->amount, 2) }}</td><td>{{ ucfirst($p->method) }}</td>
                    <td>{{ $p->payment_date?->toDateString() }}</td></tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">No payments recorded.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@elseif ($search)
    <div class="alert alert-warning">No student found.</div>
@endif
@endsection
