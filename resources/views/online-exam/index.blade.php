@extends('layouts.app')
@section('title', 'Online Exams')
@section('content')
<div class="table-card p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Online Exams</h5>
        @if (in_array(auth()->user()->role, ['admin', 'teacher']))
            <a href="{{ route('online-exams.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg me-1"></i>Add New</a>
        @endif
    </div>
    <table class="table table-hover align-middle small">
        <thead class="table-light"><tr><th>#</th><th>Title</th><th>Class</th><th>Subject</th><th>Date</th><th>Duration</th><th>Total Mark</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->schoolClass->name ?? '-' }}</td>
                    <td>{{ $item->subject->name ?? '-' }}</td>
                    <td>{{ $item->date?->toDateString() }}</td>
                    <td>{{ $item->duration_minutes }} min</td>
                    <td>{{ $item->total_mark }}</td>
                    <td><span class="badge bg-{{ $item->status === 'published' ? 'success' : ($item->status === 'closed' ? 'secondary' : 'warning') }}">{{ ucfirst($item->status) }}</span></td>
                    <td class="text-end text-nowrap">
                        @if (auth()->user()->role === 'student')
                            @if (isset($attempts[$item->id]))
                                <span class="badge bg-info">Score: {{ $attempts[$item->id] }}</span>
                            @elseif ($item->status === 'published')
                                <a href="{{ route('online-exams.take', $item->id) }}" class="btn btn-sm btn-success">Take Exam</a>
                            @endif
                        @else
                            <a href="{{ route('online-exams.questions', $item->id) }}" class="btn btn-sm btn-outline-secondary" title="Manage Questions"><i class="bi bi-list-check"></i></a>
                            <a href="{{ route('online-exams.edit', $item->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('online-exams.destroy', $item->id) }}" class="d-inline" onsubmit="return confirm('Delete this exam?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" class="text-center text-muted py-4">No online exams found.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $items->links() }}
</div>
@endsection
