@extends('layouts.app')
@section('title', 'General Settings')
@section('content')
<div class="table-card p-4" style="max-width: 900px;">
    <form method="POST" enctype="multipart/form-data">@csrf
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">School Name</label>
                <input type="text" name="school_name" value="{{ $s['school_name'] ?? config('app.name') }}" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">School Code</label>
                <input type="text" name="school_code" value="{{ $s['school_code'] ?? '' }}" class="form-control"></div>
            <div class="col-md-12"><label class="form-label">Address</label>
                <input type="text" name="address" value="{{ $s['address'] ?? '' }}" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ $s['phone'] ?? '' }}" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">Email</label>
                <input type="email" name="email" value="{{ $s['email'] ?? '' }}" class="form-control"></div>
            <div class="col-md-3"><label class="form-label">Currency</label>
                <input type="text" name="currency" value="{{ $s['currency'] ?? 'USD' }}" class="form-control"></div>
            <div class="col-md-3"><label class="form-label">Currency Symbol</label>
                <input type="text" name="currency_symbol" value="{{ $s['currency_symbol'] ?? '$' }}" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">Current Session</label>
                <input type="text" name="session" value="{{ $s['session'] ?? '' }}" class="form-control" placeholder="2025-2026"></div>
            <div class="col-md-6"><label class="form-label">Footer Text</label>
                <input type="text" name="footer_text" value="{{ $s['footer_text'] ?? '' }}" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">School Logo</label>
                <input type="file" name="logo" class="form-control" accept=".jpg,.jpeg,.png">
                @if (!empty($s['logo']))<img src="{{ asset('storage/' . $s['logo']) }}" class="mt-2 rounded" height="48" alt="">@endif
            </div>
        </div>
        <div class="form-check form-switch mt-3">
            <input class="form-check-input" type="checkbox" disabled title="Toggle via code">
            <label class="form-check-label text-muted">Promote student without exam (configured in Student Promote)</label>
        </div>
        <button class="btn btn-primary mt-3"><i class="bi bi-check-lg me-1"></i>Save Settings</button>
    </form>
</div>
@endsection
