@extends('layouts.app')
@section('title', 'Mark Sheet Report')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4"><label class="form-label small">Exam</label>
            <select name="exam_id" class="form-select form-select-sm" required><option value="">-- Select --</option>
                @foreach ($exams as $id => $name)<option value="{{ $id }}" {{ request('exam_id') == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
            </select></div>
        <div class="col-md-3"><label class="form-label small">Student (admission no / name)</label>
            <input type="text" name="search" value="{{ $search }}" class="form-control form-control-sm" required></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Generate</button></div>
    </form>
</div>
@if ($student && $exam)
<div class="table-card p-4 mx-auto" style="max-width: 720px;">
    <div class="text-center mb-3">
        <h5 class="mb-0">{{ config('app.name') }}</h5>
        <div class="text-muted small">Mark Sheet - {{ $exam->name }}</div>
    </div>
    <div class="row small mb-3">
        <div class="col-6"><strong>Student:</strong> {{ $student->fullName() }}<br><strong>Roll:</strong> {{ $student->roll_no }}</div>
        <div class="col-6"><strong>Class:</strong> {{ $student->schoolClass->name ?? '-' }} ({{ $student->section->name ?? '' }})<br><strong>Full Mark:</strong> {{ $exam->exam_mark }} / subject</div>
    </div>
    <table class="table table-bordered">
        <thead class="table-light"><tr><th>Subject</th><th class="text-end">Marks</th><th>Grade</th></tr></thead>
        <tbody>
            @forelse ($marks as $m)
                <tr><td>{{ $m->subject->name ?? '-' }}</td><td class="text-end">{{ $m->marks }}</td><td>{{ $m->grade }}</td></tr>
            @empty
                <tr><td colspan="3" class="text-center text-muted">No marks recorded for this exam.</td></tr>
            @endforelse
            @if ($marks->isNotEmpty())
                <tr class="fw-bold"><td>Total</td><td class="text-end">{{ $marks->sum('marks') }}</td><td></td></tr>
            @endif
        </tbody>
    </table>
    <button class="btn btn-outline-secondary btn-sm" onclick="window.print()"><i class="bi bi-printer me-1"></i>Print</button>
</div>
@elseif ($search)
    <div class="alert alert-warning">No student found.</div>
@endif
@endsection
