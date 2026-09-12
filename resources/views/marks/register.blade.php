@extends('layouts.app')
@section('title', 'Mark Register')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4"><label class="form-label small">Exam</label>
            <select name="exam_id" class="form-select form-select-sm" required><option value="">-- Select Exam --</option>
                @foreach ($exams as $id => $name)<option value="{{ $id }}" {{ $exam_id == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
            </select></div>
        <div class="col-md-4"><label class="form-label small">Subject</label>
            <select name="subject_id" class="form-select form-select-sm" required><option value="">-- Select Subject --</option>
                @foreach ($subjects as $id => $name)<option value="{{ $id }}" {{ $subject_id == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
            </select></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Load Students</button></div>
    </form>
</div>
@if ($exam && $students->isNotEmpty())
<div class="table-card p-3">
    <h6>{{ $exam->name }} &middot; Full mark: {{ $exam->exam_mark }}</h6>
    <form method="POST">@csrf
        <input type="hidden" name="exam_id" value="{{ $exam_id }}">
        <input type="hidden" name="subject_id" value="{{ $subject_id }}">
        <table class="table table-sm table-hover align-middle">
            <thead class="table-light"><tr><th>Roll</th><th>Student</th><th style="width: 160px;">Marks (out of {{ $exam->exam_mark }})</th></tr></thead>
            <tbody>
                @foreach ($students as $s)
                    <tr><td>{{ $s->roll_no }}</td><td>{{ $s->fullName() }}</td>
                        <td><input type="number" step="0.01" min="0" max="{{ $exam->exam_mark }}" name="marks[{{ $s->id }}]" value="{{ $existing[$s->id] ?? '' }}" class="form-control form-control-sm"></td></tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save Marks</button>
    </form>
</div>
@elseif ($exam)
    <div class="alert alert-info">No students found for this exam's class/section.</div>
@endif
@endsection
