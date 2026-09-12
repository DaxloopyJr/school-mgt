@extends('layouts.app')
@section('title', 'Exam Results')
@section('content')
@include('panel._child-picker')
@if ($student)
    @forelse ($results as $r)
        <div class="table-card p-3 mb-3">
            <h6>{{ $r['exam']->name }} <span class="badge bg-primary">Total: {{ $r['total'] }}</span></h6>
            <div>
                @foreach ($r['marks'] as $m)
                    <span class="badge bg-light text-dark border me-1">{{ $m->subject->name ?? '' }}: {{ $m->marks }} ({{ $m->grade }})</span>
                @endforeach
            </div>
        </div>
    @empty
        <div class="alert alert-info">No results published yet.</div>
    @endforelse
@else
    <div class="alert alert-info">No student record linked.</div>
@endif
@endsection
