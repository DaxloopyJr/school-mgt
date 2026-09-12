@extends('layouts.app')
@section('title', 'Student Transport Report')
@section('content')
@foreach ($routes as $r)
    <div class="table-card p-3 mb-3">
        <h6><i class="bi bi-signpost me-1"></i>{{ $r['route']->title }} <span class="badge bg-secondary">Fare: {{ number_format($r['route']->fare ?? 0, 2) }}</span></h6>
        <div class="small text-muted mb-2">
            Vehicles:
            @forelse ($r['route']->vehicles as $v)
                <span class="badge bg-light text-dark border">{{ $v->vehicle_no }} ({{ $v->driver_name }})</span>
            @empty
                none assigned
            @endforelse
        </div>
        <table class="table table-sm table-bordered">
            <thead class="table-light"><tr><th>Roll</th><th>Student</th><th>Class</th><th>Phone</th></tr></thead>
            <tbody>
                @forelse ($r['students'] as $s)
                    <tr><td>{{ $s->roll_no }}</td><td>{{ $s->fullName() }}</td><td>{{ $s->schoolClass->name ?? '-' }}</td><td>{{ $s->phone }}</td></tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted">No students on this route.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endforeach
@endsection
