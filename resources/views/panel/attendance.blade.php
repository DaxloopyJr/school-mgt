@extends('layouts.app')
@section('title', 'Attendance Status')
@section('content')
@include('panel._child-picker')
@if ($student)
<div class="row g-3 mb-3">
    @foreach (['present' => 'success', 'absent' => 'danger', 'late' => 'warning', 'half_day' => 'info'] as $key => $color)
        <div class="col-md-3"><div class="card stat-card shadow-sm" style="border-left-color: var(--bs-{{ $color }})"><div class="card-body py-2">
            <div class="text-muted small text-uppercase">{{ str_replace('_', ' ', $key) }}</div>
            <div class="fs-4 fw-bold">{{ $summary[$key] ?? 0 }}</div></div></div></div>
    @endforeach
</div>
<div class="table-card p-3">
    <table class="table table-sm table-hover">
        <thead class="table-light"><tr><th>Date</th><th>Status</th></tr></thead>
        <tbody>
            @forelse ($records as $r)
                <tr><td>{{ $r->date?->toDateString() }}</td>
                    <td><span class="badge bg-{{ $r->status === 'present' ? 'success' : ($r->status === 'absent' ? 'danger' : 'warning') }}">{{ ucfirst(str_replace('_', ' ', $r->status)) }}</span></td></tr>
            @empty
                <tr><td colspan="2" class="text-center text-muted py-3">No attendance records yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@else
    <div class="alert alert-info">No student record linked.</div>
@endif
@endsection
