@extends('layouts.app')
@section('title', $title)
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label small">Class</label>
            <select name="class_id" class="form-select form-select-sm" required>
                <option value="">-- Select --</option>
                @foreach ($classes as $id => $name)<option value="{{ $id }}" {{ $class_id == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label small">Section</label>
            <select name="section_id" class="form-select form-select-sm"><option value="">All</option>
                @foreach ($sections as $id => $name)<option value="{{ $id }}" {{ $section_id == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
            </select>
        </div>
        @if ($mode === 'subject')
            <div class="col-md-3">
                <label class="form-label small">Subject</label>
                <select name="subject_id" class="form-select form-select-sm" required><option value="">-- Select --</option>
                    @foreach ($subjects as $id => $name)<option value="{{ $id }}" {{ $subject_id == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
                </select>
            </div>
        @endif
        <div class="col-md-2">
            <label class="form-label small">Month</label>
            <input type="number" name="month" min="1" max="12" value="{{ $month }}" class="form-control form-control-sm">
        </div>
        <div class="col-md-2">
            <label class="form-label small">Year</label>
            <input type="number" name="year" value="{{ $year }}" class="form-control form-control-sm">
        </div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Generate</button></div>
    </form>
</div>
@if ($rows->isNotEmpty())
<div class="table-card p-3">
    <div class="d-flex justify-content-between mb-2"><h6 class="mb-0">{{ $title }} - {{ $month }}/{{ $year }}</h6>
        <button class="btn btn-sm btn-outline-secondary" onclick="window.print()"><i class="bi bi-printer me-1"></i>Print</button></div>
    <table class="table table-sm table-bordered">
        <thead class="table-light"><tr><th>Roll</th><th>Student</th><th class="text-center text-success">Present</th><th class="text-center text-danger">Absent</th><th class="text-center text-warning">Late</th><th class="text-center">Half Day</th><th class="text-center">Attendance %</th></tr></thead>
        <tbody>
            @foreach ($rows as $r)
                @php
                    $p = $r['att']['present'] ?? 0; $a = $r['att']['absent'] ?? 0; $l = $r['att']['late'] ?? 0; $h = $r['att']['half_day'] ?? 0;
                    $total = $p + $a + $l + $h; $pct = $total ? round(($p + $l + $h * 0.5) / $total * 100, 1) : 0;
                @endphp
                <tr><td>{{ $r['student']->roll_no }}</td><td>{{ $r['student']->fullName() }}</td>
                    <td class="text-center">{{ $p }}</td><td class="text-center">{{ $a }}</td><td class="text-center">{{ $l }}</td><td class="text-center">{{ $h }}</td>
                    <td class="text-center"><span class="badge bg-{{ $pct >= 75 ? 'success' : 'danger' }}">{{ $pct }}%</span></td></tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
