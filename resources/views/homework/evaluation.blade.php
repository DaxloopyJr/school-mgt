@extends('layouts.app')
@section('title', 'Homework Evaluation Report')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-5"><label class="form-label small">Homework</label>
            <select name="homework_id" class="form-select form-select-sm" required><option value="">-- Select --</option>
                @foreach ($homeworks as $id => $label)<option value="{{ $id }}" {{ request('homework_id') == $id ? 'selected' : '' }}>{{ $label }}</option>@endforeach
            </select></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Load</button></div>
    </form>
</div>
@if ($homework)
<div class="table-card p-3">
    <h6>{{ $homework->schoolClass->name ?? '' }} {{ $homework->section->name ?? '' }} &middot; {{ $homework->subject->name ?? '' }} &middot; Submit by {{ $homework->submission_date?->toDateString() }} ({{ $homework->marks }} marks)</h6>
    <table class="table table-sm table-bordered">
        <thead class="table-light"><tr><th>Roll</th><th>Student</th><th>Status</th><th class="text-end">Marks</th><th>Note</th></tr></thead>
        <tbody>
            @foreach ($rows as $r)
                <tr><td>{{ $r['student']->roll_no }}</td><td>{{ $r['student']->fullName() }}</td>
                    @if ($r['eval'])
                        <td><span class="badge bg-{{ $r['eval']->status === 'completed' || $r['eval']->status === 'excellent' ? 'success' : 'warning' }}">{{ ucfirst($r['eval']->status) }}</span></td>
                        <td class="text-end">{{ $r['eval']->marks }}</td><td>{{ $r['eval']->note }}</td>
                    @else
                        <td><span class="badge bg-secondary">Not evaluated</span></td><td></td><td></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('homework-evaluations.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg me-1"></i>Add Evaluation</a>
</div>
@endif
@endsection
