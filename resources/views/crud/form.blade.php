@extends('layouts.app')
@section('title', ($item ? 'Edit ' : 'Add ') . $title)
@section('content')
<div class="table-card p-4" style="max-width: 900px;">
    <h5 class="mb-3">{{ $item ? 'Edit' : 'Add' }} {{ $title }}</h5>
    <form method="POST" action="{{ $item ? route($route . '.update', $item->id) : route($route . '.store') }}" enctype="multipart/form-data">
        @csrf
        @if ($item) @method('PUT') @endif
        <div class="row g-3">
            @foreach ($fields as $f)
                @php $type = $f['type'] ?? 'text'; $value = old($f['name'], $item->{$f['name']} ?? ($f['default'] ?? '')); @endphp
                <div class="col-md-{{ $f['col'] ?? ($type === 'textarea' ? 12 : 6) }}">
                    <label class="form-label">{{ $f['label'] }} @if(!empty($f['required']))<span class="text-danger">*</span>@endif</label>
                    @if ($type === 'textarea')
                        <textarea name="{{ $f['name'] }}" class="form-control" rows="{{ $f['rows'] ?? 3 }}" {{ !empty($f['required']) ? 'required' : '' }}>{{ $value }}</textarea>
                    @elseif ($type === 'select')
                        <select name="{{ $f['name'] }}" class="form-select" {{ !empty($f['required']) ? 'required' : '' }}>
                            <option value="">-- Select {{ $f['label'] }} --</option>
                            @foreach (($f['options'] ?? []) as $k => $v)
                                <option value="{{ $k }}" {{ (string)$value === (string)$k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    @elseif ($type === 'checkbox')
                        <div class="form-check form-switch mt-2">
                            <input type="hidden" name="{{ $f['name'] }}" value="0">
                            <input class="form-check-input" type="checkbox" name="{{ $f['name'] }}" value="1" {{ $value ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $f['hint'] ?? 'Enabled' }}</label>
                        </div>
                    @elseif ($type === 'file')
                        <input type="file" name="{{ $f['name'] }}" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.mp4,.mp3" {{ !empty($f['required']) && !$item ? 'required' : '' }}>
                        @if ($item && $item->{$f['name']})
                            <small class="text-muted">Current: <a href="{{ asset('storage/' . $item->{$f['name']}) }}" target="_blank">view file</a></small>
                        @endif
                        <small class="text-muted d-block">Allowed: jpg, png, jpeg, pdf, doc, docx, mp4, mp3 (max 20MB)</small>
                    @elseif ($type === 'number' || $type === 'integer')
                        <input type="number" step="{{ $f['step'] ?? 'any' }}" name="{{ $f['name'] }}" value="{{ $value }}" class="form-control" {{ !empty($f['required']) ? 'required' : '' }}>
                    @elseif ($type === 'date')
                        <input type="date" name="{{ $f['name'] }}" value="{{ $value }}" class="form-control" {{ !empty($f['required']) ? 'required' : '' }}>
                    @elseif ($type === 'time')
                        <input type="time" name="{{ $f['name'] }}" value="{{ $value }}" class="form-control" {{ !empty($f['required']) ? 'required' : '' }}>
                    @elseif ($type === 'email')
                        <input type="email" name="{{ $f['name'] }}" value="{{ $value }}" class="form-control" {{ !empty($f['required']) ? 'required' : '' }}>
                    @elseif ($type === 'password')
                        <input type="password" name="{{ $f['name'] }}" class="form-control" {{ !empty($f['required']) && !$item ? 'required' : '' }} placeholder="{{ $item ? 'Leave blank to keep current' : '' }}">
                    @else
                        <input type="text" name="{{ $f['name'] }}" value="{{ $value }}" class="form-control" {{ !empty($f['required']) ? 'required' : '' }}>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            <button class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>{{ $item ? 'Update' : 'Save' }}</button>
            <a href="{{ route($route . '.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
