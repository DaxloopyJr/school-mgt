@extends('layouts.app')
@section('title', 'Payment Invoices')
@section('content')
@include('panel._child-picker')
@if ($student)
<div class="row g-3">
    <div class="col-lg-5">
        <div class="table-card p-3">
            <h6>Due Fee Items</h6>
            <table class="table table-sm table-bordered">
                <thead class="table-light"><tr><th>Fee</th><th class="text-end">Amount</th><th class="text-end">Due</th><th></th></tr></thead>
                <tbody>
                    @foreach ($masters as $m)
                        @php $due = max(0, $m->amount - ($paidMap[$m->id] ?? 0)); @endphp
                        <tr><td>{{ $m->feesType->name ?? '-' }}</td>
                            <td class="text-end">{{ number_format($m->amount, 2) }}</td>
                            <td class="text-end text-danger">{{ number_format($due, 2) }}</td>
                            <td>@if ($due > 0)<a href="{{ route('panel.pay', ['master' => $m->id, 'student' => $student->id]) }}" class="btn btn-sm btn-success">Pay Online</a>
                                @else<span class="badge bg-success">Paid</span>@endif</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="table-card p-3">
            <h6>Invoices</h6>
            <table class="table table-sm table-hover">
                <thead class="table-light"><tr><th>Invoice</th><th>Fee</th><th class="text-end">Amount</th><th>Method</th><th>Date</th><th></th></tr></thead>
                <tbody>
                    @forelse ($payments as $p)
                        <tr><td>{{ $p->invoice_no }}</td><td>{{ $p->feesMaster->feesType->name ?? '-' }}</td>
                            <td class="text-end">{{ number_format($p->amount, 2) }}</td><td>{{ ucfirst($p->method) }}</td>
                            <td>{{ $p->payment_date?->toDateString() }}</td>
                            <td><a href="{{ route('fees.invoice', $p->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-receipt"></i></a></td></tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-3">No invoices yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
    <div class="alert alert-info">No student record linked.</div>
@endif
@endsection
