@extends('layouts.app')
@section('title', 'Email Settings')
@section('content')
<div class="table-card p-4" style="max-width: 720px;">
    <form method="POST">@csrf
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Mail Driver</label>
                <select name="mail_mailer" class="form-select">
                    @foreach (['log', 'smtp'] as $m)<option value="{{ $m }}" {{ ($s['mail_mailer'] ?? 'log') === $m ? 'selected' : '' }}>{{ strtoupper($m) }}</option>@endforeach
                </select></div>
            <div class="col-md-6"><label class="form-label">SMTP Host</label>
                <input type="text" name="mail_host" value="{{ $s['mail_host'] ?? '' }}" class="form-control"></div>
            <div class="col-md-3"><label class="form-label">Port</label>
                <input type="text" name="mail_port" value="{{ $s['mail_port'] ?? '587' }}" class="form-control"></div>
            <div class="col-md-3"><label class="form-label">Encryption</label>
                <select name="mail_encryption" class="form-select">
                    @foreach (['tls', 'ssl', ''] as $e)<option value="{{ $e }}" {{ ($s['mail_encryption'] ?? 'tls') === $e ? 'selected' : '' }}>{{ $e ?: 'none' }}</option>@endforeach
                </select></div>
            <div class="col-md-6"><label class="form-label">Username</label>
                <input type="text" name="mail_username" value="{{ $s['mail_username'] ?? '' }}" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">From Address</label>
                <input type="email" name="mail_from_address" value="{{ $s['mail_from_address'] ?? '' }}" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">From Name</label>
                <input type="text" name="mail_from_name" value="{{ $s['mail_from_name'] ?? '' }}" class="form-control"></div>
        </div>
        <button class="btn btn-primary mt-3">Save</button>
    </form>
</div>
@endsection
