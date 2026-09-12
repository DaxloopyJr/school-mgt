@extends('layouts.app')
@section('title', 'Invoice ' . $payment->invoice_no)
@section('content')
<div class="table-card p-4" style="max-width: 720px;" id="invoice">
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h5 class="mb-0">{{ config('app.name') }}</h5>
            <div class="small text-muted">Fees Receipt</div>
        </div>
        <div class="text-end">
            <h6 class="mb-0">{{ $payment->invoice_no }}</h6>
            <div class="small text-muted">{{ $payment->payment_date?->toDateString() }}</div>
        </div>
    </div>
    <hr>
    <div class="row small mb-3">
        <div class="col-6"><strong>Student:</strong> {{ $payment->student->fullName() ?? '-' }}<br>
            <strong>Class:</strong> {{ $payment->student->schoolClass->name ?? '-' }} ({{ $payment->student->section->name ?? '' }})<br>
            <strong>Admission No:</strong> {{ $payment->student->admission_no ?? '' }}</div>
        <div class="col-6"><strong>Fee:</strong> {{ $payment->feesMaster->feesType->name ?? '-' }}<br>
            <strong>Method:</strong> {{ ucfirst($payment->method) }}<br>
            <strong>Received By:</strong> {{ $payment->receivedBy->name ?? '-' }}</div>
    </div>
    <table class="table table-bordered">
        <thead class="table-light"><tr><th>Description</th><th class="text-end">Amount</th></tr></thead>
        <tbody>
            <tr><td>{{ $payment->feesMaster->feesType->name ?? 'Fees' }} payment</td><td class="text-end">{{ number_format($payment->amount, 2) }}</td></tr>
            @if ($payment->discount_amount)<tr><td>Discount</td><td class="text-end">-{{ number_format($payment->discount_amount, 2) }}</td></tr>@endif
            @if ($payment->fine)<tr><td>Fine</td><td class="text-end">{{ number_format($payment->fine, 2) }}</td></tr>@endif
            <tr class="fw-bold"><td>Total Received</td><td class="text-end">{{ number_format($payment->amount, 2) }}</td></tr>
        </tbody>
    </table>
    @if ($payment->note)<p class="small text-muted">Note: {{ $payment->note }}</p>@endif
    <div class="d-flex gap-2 mt-3">
        <button class="btn btn-outline-secondary" onclick="window.print()"><i class="bi bi-printer me-1"></i>Print</button>
        <a href="{{ route('fees.collect') }}" class="btn btn-primary">Collect Another</a>
    </div>
</div>
@endsection
