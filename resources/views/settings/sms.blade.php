@extends('layouts.app')
@section('title', 'SMS Settings')
@section('content')
<div class="table-card p-4" style="max-width: 720px;">
    <form method="POST">@csrf
        <div class="mb-3"><label class="form-label">SMS Gateway</label>
            <select name="sms_gateway" class="form-select">
                @foreach (['none' => 'None (log only)', 'twilio' => 'Twilio', 'nexmo' => 'Vonage (Nexmo)', 'local' => 'Local Gateway'] as $k => $label)
                    <option value="{{ $k }}" {{ ($s['sms_gateway'] ?? 'none') === $k ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select></div>
        <div class="mb-3"><label class="form-label">API Key</label>
            <input type="text" name="sms_api_key" value="{{ $s['sms_api_key'] ?? '' }}" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Sender ID</label>
            <input type="text" name="sms_sender_id" value="{{ $s['sms_sender_id'] ?? '' }}" class="form-control"></div>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
