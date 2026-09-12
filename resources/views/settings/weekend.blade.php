@extends('layouts.app')
@section('title', 'Weekend Setup')
@section('content')
<div class="table-card p-4" style="max-width: 480px;">
    <form method="POST">@csrf
        @foreach (['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" name="days[]" value="{{ $day }}" id="d{{ $day }}" {{ in_array($day, $weekends ?? []) ? 'checked' : '' }}>
                <label class="form-check-label" for="d{{ $day }}">{{ $day }}</label>
            </div>
        @endforeach
        <button class="btn btn-primary mt-2">Save</button>
    </form>
</div>
@endsection
