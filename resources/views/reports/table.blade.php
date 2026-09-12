@extends('layouts.app')
@section('title', $title)
@section('content')
@if (($filter ?? 'none') !== 'none')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        @if (in_array($filter, ['class']))
            <div class="col-md-3"><label class="form-label small">Class</label>
                <select name="class_id" class="form-select form-select-sm" required><option value="">-- Select --</option>
                    @foreach ($classes as $id => $name)<option value="{{ $id }}" {{ request('class_id') == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
                </select></div>
            <div class="col-md-2"><label class="form-label small">Section</label>
                <select name="section_id" class="form-select form-select-sm"><option value="">All</option>
                    @foreach ($sections as $id => $name)<option value="{{ $id }}" {{ request('section_id') == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
                </select></div>
        @elseif ($filter === 'exam')
            <div class="col-md-4"><label class="form-label small">Exam</label>
                <select name="exam_id" class="form-select form-select-sm" required><option value="">-- Select --</option>
                    @foreach ($exams as $id => $name)<option value="{{ $id }}" {{ request('exam_id') == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
                </select></div>
        @elseif ($filter === 'teacher')
            <div class="col-md-4"><label class="form-label small">Teacher</label>
                <select name="teacher_id" class="form-select form-select-sm" required><option value="">-- Select --</option>
                    @foreach ($teachers as $id => $name)<option value="{{ $id }}" {{ request('teacher_id') == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
                </select></div>
        @elseif ($filter === 'online_exam')
            <div class="col-md-4"><label class="form-label small">Online Exam</label>
                <select name="online_exam_id" class="form-select form-select-sm" required><option value="">-- Select --</option>
                    @foreach ($online_exams as $id => $name)<option value="{{ $id }}" {{ request('online_exam_id') == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
                </select></div>
        @endif
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Generate</button></div>
    </form>
</div>
@endif
<div class="table-card p-3">
    <div class="d-flex justify-content-between mb-2">
        <h6 class="mb-0">{{ $title }}</h6>
        <button class="btn btn-sm btn-outline-secondary" onclick="window.print()"><i class="bi bi-printer me-1"></i>Print</button>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover">
            <thead class="table-light"><tr>@foreach ($columns as $c)<th>{{ $c }}</th>@endforeach</tr></thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>@foreach ($row as $cell)<td>{{ $cell }}</td>@endforeach</tr>
                @empty
                    <tr><td colspan="{{ count($columns) }}" class="text-center text-muted py-3">No data. Adjust filters and generate.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
