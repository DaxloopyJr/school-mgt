@extends('layouts.app')
@section('title', 'Student Dashboard')
@section('content')
@if (!$student)
    <div class="alert alert-warning">Your account is not linked to a student record yet. Please contact the school office.</div>
@else
<div class="row g-3 mb-3">
    <div class="col-md-4">
        <div class="card stat-card shadow-sm" style="border-left-color:#1cc88a"><div class="card-body">
            <div class="text-muted small text-uppercase">Days Present</div><div class="fs-4 fw-bold">{{ $attendanceSummary['present'] ?? 0 }}</div>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card shadow-sm" style="border-left-color:#e74a3b"><div class="card-body">
            <div class="text-muted small text-uppercase">Days Absent</div><div class="fs-4 fw-bold">{{ $attendanceSummary['absent'] ?? 0 }}</div>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card shadow-sm" style="border-left-color:#4e73df"><div class="card-body">
            <div class="text-muted small text-uppercase">Class</div><div class="fs-5 fw-bold">{{ $student->schoolClass->name ?? '-' }} ({{ $student->section->name ?? '-' }})</div>
        </div></div>
    </div>
</div>
<div class="row g-3">
    <div class="col-lg-7">
        <div class="table-card p-3">
            <h6><i class="bi bi-calendar3-week me-1"></i>My Class Routine</h6>
            <table class="table table-sm table-striped small">
                <thead class="table-light"><tr><th>Day</th><th>Subject</th><th>Teacher</th><th>Time</th><th>Room</th></tr></thead>
                <tbody>
                    @forelse ($routines as $r)
                        <tr><td>{{ $r->day }}</td><td>{{ $r->subject->name ?? '-' }}</td><td>{{ $r->teacher->name ?? '-' }}</td><td>{{ $r->start_time }} - {{ $r->end_time }}</td><td>{{ $r->classRoom->name ?? '-' }}</td></tr>
                    @empty
                        <tr><td colspan="5" class="text-muted text-center">No routine published yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="table-card p-3 mb-3">
            <h6><i class="bi bi-journal-richtext me-1"></i>Latest Study Materials</h6>
            <ul class="list-group list-group-flush small">
                @forelse ($materials as $m)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $m->title }}</span>
                        @if ($m->file)<a href="{{ asset('storage/' . $m->file) }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i></a>@endif
                    </li>
                @empty
                    <li class="list-group-item text-muted">No materials uploaded yet.</li>
                @endforelse
            </ul>
        </div>
        <div class="table-card p-3">
            <h6><i class="bi bi-megaphone me-1"></i>Notices</h6>
            <ul class="list-group list-group-flush small">
                @foreach ($notices as $n)
                    <li class="list-group-item d-flex justify-content-between"><span>{{ $n->title }}</span><span class="text-muted">{{ $n->publish_date }}</span></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
@endsection
