@extends('layouts.app')
@section('title', 'Student Dormitory Report')
@section('content')
<div class="table-card p-3">
    <table class="table table-sm table-hover">
        <thead class="table-light"><tr><th>Student</th><th>Class</th><th>Dormitory</th><th>Room</th><th>Assigned Date</th><th>Status</th></tr></thead>
        <tbody>
            @forelse ($assigns as $a)
                <tr><td>{{ $a->student->fullName() ?? '-' }}</td><td>{{ $a->student->schoolClass->name ?? '-' }}</td>
                    <td>{{ $a->room->dormitory->name ?? '-' }}</td><td>{{ $a->room->name ?? '-' }}</td>
                    <td>{{ $a->assigned_date?->toDateString() }}</td>
                    <td><span class="badge bg-success">{{ ucfirst($a->status) }}</span></td></tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-3">No room assignments.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $assigns->links() }}
</div>
@endsection
