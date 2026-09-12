@extends('layouts.app')
@section('title', 'Class Routine')
@section('content')
@include('panel._child-picker')
@if ($student)
    @php $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']; @endphp
    <div class="table-card p-3">
        <h6>{{ $student->fullName() }} &middot; {{ $student->schoolClass->name ?? '' }} ({{ $student->section->name ?? '' }})</h6>
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead class="table-light"><tr><th>Day</th><th>Periods</th></tr></thead>
                <tbody>
                    @foreach ($days as $day)
                        <tr><td class="fw-semibold" style="width:120px;">{{ $day }}</td>
                            <td>
                                @forelse ($routines[$day] ?? [] as $r)
                                    <span class="badge bg-light text-dark border me-1 mb-1">{{ $r->start_time }}-{{ $r->end_time }} {{ $r->subject->name ?? '' }} ({{ $r->teacher->name ?? '' }})</span>
                                @empty
                                    <span class="text-muted small">-</span>
                                @endforelse
                            </td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="alert alert-info">No student record linked.</div>
@endif
@endsection
