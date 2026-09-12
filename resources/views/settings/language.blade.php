@extends('layouts.app')
@section('title', 'Language Settings')
@section('content')
<div class="table-card p-4" style="max-width: 480px;">
    <form method="POST">@csrf
        <div class="mb-3"><label class="form-label">Default Language</label>
            <select name="default_language" class="form-select">
                @foreach (['en' => 'English', 'bn' => 'Bangla', 'hi' => 'Hindi', 'ar' => 'Arabic'] as $k => $label)
                    <option value="{{ $k }}" {{ ($s['default_language'] ?? 'en') === $k ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select></div>
        <div class="form-check form-switch mb-3">
            <input type="hidden" name="rtl" value="0">
            <input class="form-check-input" type="checkbox" name="rtl" value="1" {{ ($s['rtl'] ?? '0') == '1' ? 'checked' : '' }}>
            <label class="form-check-label">Right-to-left layout (RTL)</label>
        </div>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
