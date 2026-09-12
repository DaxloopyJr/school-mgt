@extends('layouts.app')
@section('title', 'Pay Online')
@section('content')
<div class="table-card p-4 mx-auto" style="max-width: 480px;">
    <h6><i class="bi bi-credit-card me-1"></i>Online Payment</h6>
    <p class="small text-muted mb-3">Student: {{ $student->fullName() }} &middot; Fee: {{ $master->feesType->name ?? '' }} ({{ number_format($master->amount, 2) }})</p>
    <form method="POST" action="{{ route('panel.pay.submit', ['master' => $master->id, 'student' => $student->id]) }}">@csrf
        <div class="mb-2"><label class="form-label small">Amount</label>
            <input type="number" step="0.01" min="0.01" name="amount" value="{{ $master->amount }}" class="form-control" required></div>
        <div class="mb-2"><label class="form-label small">Card Number (demo)</label>
            <input type="text" class="form-control" placeholder="4242 4242 4242 4242"></div>
        <div class="row g-2">
            <div class="col-6"><label class="form-label small">Expiry</label><input type="text" class="form-control" placeholder="12/28"></div>
            <div class="col-6"><label class="form-label small">CVC</label><input type="text" class="form-control" placeholder="123"></div>
        </div>
        <button class="btn btn-success w-100 mt-3"><i class="bi bi-lock me-1"></i>Pay Now</button>
        <p class="small text-muted mt-2 mb-0">Demo gateway: no real charge is made; a paid invoice is generated instantly. Connect a real gateway (Stripe/SSLCommerz/bKash) in production.</p>
    </form>
</div>
@endsection
