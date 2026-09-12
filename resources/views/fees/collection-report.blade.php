@extends('layouts.app')
@section('title', 'Collection Report')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3"><label class="form-label small">From</label><input type="date" name="from" value="{{ $from }}" class="form-control form-control-sm"></div>
        <div class="col-md-3"><label class="form-label small">To</label><input type="date" name="to" value="{{ $to }}" class="form-control form-control-sm"></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Generate</button></div>
        <div class="col-md-2"><button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="window.print()"><i class="bi bi-printer"></i> Print</button></div>
    </form>
</div>
<div class="table-card p-3">
    <table class="table table-sm table-bordered">
        <thead class="table-light"><tr><th>Date</th><th>Method</th><th class="text-center">Receipts</th><th class="text-end">Collected</th></tr></thead>
        <tbody>
            @forelse ($rows as $r)
                <tr><td>{{ $r->payment_date }}</td><td>{{ ucfirst($r->method) }}</td><td class="text-center">{{ $r->receipts }}</td><td class="text-end">{{ number_format($r->total, 2) }}</td></tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">No collections in this period.</td></tr>
            @endforelse
        </tbody>
        <tfoot class="table-light fw-bold"><tr><td colspan="3">Grand Total</td><td class="text-end">{{ number_format($grand, 2) }}</td></tr></tfoot>
    </table>
</div>
@endsection
