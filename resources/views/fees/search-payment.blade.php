@extends('layouts.app')
@section('title', 'Search Fees Payment')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3"><label class="form-label small">Invoice No</label><input type="text" name="invoice_no" value="{{ request('invoice_no') }}" class="form-control form-control-sm"></div>
        <div class="col-md-3"><label class="form-label small">Student</label><input type="text" name="student" value="{{ request('student') }}" class="form-control form-control-sm"></div>
        <div class="col-md-2"><label class="form-label small">From</label><input type="date" name="from" value="{{ request('from') }}" class="form-control form-control-sm"></div>
        <div class="col-md-2"><label class="form-label small">To</label><input type="date" name="to" value="{{ request('to') }}" class="form-control form-control-sm"></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Search</button></div>
    </form>
</div>
<div class="table-card p-3">
    <table class="table table-sm table-hover">
        <thead class="table-light"><tr><th>Invoice</th><th>Student</th><th>Fee Type</th><th class="text-end">Amount</th><th>Method</th><th>Date</th><th></th></tr></thead>
        <tbody>
            @forelse ($payments as $p)
                <tr><td>{{ $p->invoice_no }}</td><td>{{ $p->student->fullName() ?? '-' }}</td>
                    <td>{{ $p->feesMaster->feesType->name ?? '-' }}</td>
                    <td class="text-end">{{ number_format($p->amount, 2) }}</td><td>{{ ucfirst($p->method) }}</td>
                    <td>{{ $p->payment_date?->toDateString() }}</td>
                    <td><a href="{{ route('fees.invoice', $p->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-receipt"></i></a></td></tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted py-3">No payments found.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $payments->links() }}
</div>
@endsection
