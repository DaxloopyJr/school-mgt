@extends('layouts.app')
@section('title', 'Teacher Dashboard')
@section('content')
<div class="row g-3 mb-3">
    <div class="col-md-4">
        <div class="card stat-card shadow-sm" style="border-left-color:#4e73df"><div class="card-body">
            <div class="text-muted small text-uppercase">Total Students</div><div class="fs-4 fw-bold">{{ $studentsCount }}</div>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card shadow-sm" style="border-left-color:#1cc88a"><div class="card-body">
            <div class="text-muted small text-uppercase">My Homeworks</div><div class="fs-4 fw-bold">{{ $homeworks->count() }}</div>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card shadow-sm" style="border-left-color:#f6c23e"><div class="card-body">
            <div class="text-muted small text-uppercase">Weekly Periods</div><div class="fs-4 fw-bold">{{ $routines->count() }}</div>
        </div></div>
    </div>
</div>
<div class="row g-3">
    <div class="col-lg-7">
        <div class="table-card p-3">
            <h6><i class="bi bi-calendar3-week me-1"></i>My Class Routine</h6>
            <table class="table table-sm table-striped small">
                <thead class="table-light"><tr><th>Day</th><th>Class</th><th>Section</th><th>Subject</th><th>Time</th><th>Room</th></tr></thead>
                <tbody>
                    @forelse ($routines as $r)
                        <tr><td>{{ $r->day }}</td><td>{{ $r->schoolClass->name ?? '-' }}</td><td>{{ $r->section->name ?? '-' }}</td><td>{{ $r->subject->name ?? '-' }}</td><td>{{ $r->start_time }} - {{ $r->end_time }}</td><td>{{ $r->classRoom->name ?? '-' }}</td></tr>
                    @empty
                        <tr><td colspan="6" class="text-muted text-center">No routine assigned.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="table-card p-3 mb-3">
            <h6><i class="bi bi-pencil-square me-1"></i>Recent Homework</h6>
            <ul class="list-group list-group-flush small">
                @forelse ($homeworks as $h)
                    <li class="list-group-item d-flex justify-content-between"><span>{{ \Illuminate\Support\Str::limit($h->description, 40) }}</span><span class="text-muted">{{ $h->homework_date }}</span></li>
                @empty
                    <li class="list-group-item text-muted">No homework added yet.</li>
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
@endsection
