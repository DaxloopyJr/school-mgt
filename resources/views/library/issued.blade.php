@extends('layouts.app')
@section('title', 'All Issued Books')
@section('content')
<div class="table-card p-3">
    <table class="table table-sm table-hover">
        <thead class="table-light"><tr><th>Book</th><th>Member Card</th><th>Member</th><th>Issue Date</th><th>Due Date</th><th>Status</th></tr></thead>
        <tbody>
            @forelse ($issues as $i)
                @php $overdue = $i->due_date && $i->due_date->isPast(); @endphp
                <tr>
                    <td>{{ $i->book->title ?? '-' }}</td>
                    <td>{{ $i->libraryMember->card_no ?? '-' }}</td>
                    <td>{{ $i->libraryMember->student->fullName() ?? $i->libraryMember->staff->name ?? '-' }}</td>
                    <td>{{ $i->issue_date?->toDateString() }}</td>
                    <td class="{{ $overdue ? 'text-danger fw-bold' : '' }}">{{ $i->due_date?->toDateString() }} {{ $overdue ? '(overdue)' : '' }}</td>
                    <td><span class="badge bg-warning text-dark">Issued</span></td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-3">No books currently issued.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $issues->links() }}
</div>
@endsection
