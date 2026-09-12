@extends('layouts.app')
@section('title', 'Progress Card Report')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4"><label class="form-label small">Student (admission no / name)</label>
            <input type="text" name="search" value="{{ $search }}" class="form-control form-control-sm" required></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Generate</button></div>
    </form>
</div>
@if ($student)
<div class="table-card p-3">
    <div class="d-flex justify-content-between">
        <h6>{{ $student->fullName() }} &middot; {{ $student->schoolClass->name ?? '' }} ({{ $student->section->name ?? '' }})</h6>
        <button class="btn btn-sm btn-outline-secondary" onclick="window.print()"><i class="bi bi-printer"></i> Print</button>
    </div>
    @forelse ($exams as $r)
        <div class="border rounded p-3 mb-2">
            <div class="d-flex justify-content-between"><strong>{{ $r['exam']->name }}</strong><span>Total: {{ $r['total'] }}</span></div>
            <div class="mt-1">
                @foreach ($r['marks'] as $m)
                    <span class="badge bg-light text-dark border">{{ $m->subject->name ?? '' }}: {{ $m->marks }} ({{ $m->grade }})</span>
                @endforeach
            </div>
        </div>
    @empty
        <div class="text-muted">No exam results recorded yet.</div>
    @endforelse
</div>
@elseif ($search)
    <div class="alert alert-warning">No student found.</div>
@endif
@endsection
