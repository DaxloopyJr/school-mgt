@extends('layouts.app')
@section('title', 'My Students')
@section('content')
<div class="table-card p-3">
    <table class="table table-sm table-hover">
        <thead class="table-light"><tr><th>Roll</th><th>Student</th><th>Class</th><th>Section</th><th>Phone</th></tr></thead>
        <tbody>
            @forelse ($students as $s)
                <tr><td>{{ $s->roll_no }}</td><td>{{ $s->fullName() }}</td>
                    <td>{{ $s->schoolClass->name ?? '-' }}</td><td>{{ $s->section->name ?? '-' }}</td><td>{{ $s->phone }}</td></tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-3">No students in your assigned classes.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $students->links() }}
</div>
@endsection
