@extends('layouts.app')
@section('title', 'Disabled Students')
@section('content')
<div class="table-card p-3">
    <table class="table table-sm table-hover align-middle">
        <thead class="table-light"><tr><th>Admission No</th><th>Student</th><th>Class</th><th>Phone</th><th class="text-end">Action</th></tr></thead>
        <tbody>
            @forelse ($students as $s)
                <tr><td>{{ $s->admission_no }}</td><td>{{ $s->fullName() }}</td>
                    <td>{{ $s->schoolClass->name ?? '-' }} ({{ $s->section->name ?? '' }})</td><td>{{ $s->phone }}</td>
                    <td class="text-end">
                        <form method="POST" action="{{ route('students.toggle', $s->id) }}" class="d-inline">@csrf
                            <button class="btn btn-sm btn-outline-success">Enable</button></form>
                    </td></tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-3">No disabled students.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $students->links() }}
</div>
@endsection
