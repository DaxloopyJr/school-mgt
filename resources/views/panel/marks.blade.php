@extends('layouts.app')
@section('title', 'Exam Marks')
@section('content')
@include('panel._child-picker')
@if ($student)
    @forelse ($rows as $examId => $marks)
        <div class="table-card p-3 mb-3">
            <h6>{{ $marks->first()->exam->name ?? 'Exam' }} <span class="badge bg-primary">Total: {{ $marks->sum('marks') }}</span></h6>
            <table class="table table-sm table-bordered">
                <thead class="table-light"><tr><th>Subject</th><th class="text-end">Marks</th><th>Grade</th></tr></thead>
                <tbody>
                    @foreach ($marks as $m)
                        <tr><td>{{ $m->subject->name ?? '-' }}</td><td class="text-end">{{ $m->marks }}</td><td>{{ $m->grade }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @empty
        <div class="alert alert-info">No marks published yet.</div>
    @endforelse
@else
    <div class="alert alert-info">No student record linked.</div>
@endif
@endsection
