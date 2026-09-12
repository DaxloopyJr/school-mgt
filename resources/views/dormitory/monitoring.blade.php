@extends('layouts.app')
@section('title', 'Rooms Monitoring')
@section('content')
<div class="row g-3">
    @foreach ($rooms as $r)
        @php $pct = $r['room']->no_of_beds ? round($r['occupied'] / $r['room']->no_of_beds * 100) : 0; @endphp
        <div class="col-md-4">
            <div class="table-card p-3">
                <div class="d-flex justify-content-between">
                    <strong>{{ $r['room']->dormitory->name ?? '' }} - {{ $r['room']->name }}</strong>
                    <span class="badge bg-{{ $r['free'] > 0 ? 'success' : 'danger' }}">{{ $r['free'] }} free</span>
                </div>
                <div class="small text-muted">{{ $r['room']->roomType->name ?? '' }} &middot; {{ number_format($r['room']->cost_per_bed ?? 0, 2) }}/bed</div>
                <div class="progress mt-2" style="height: 8px;">
                    <div class="progress-bar {{ $pct >= 100 ? 'bg-danger' : 'bg-primary' }}" style="width: {{ $pct }}%"></div>
                </div>
                <div class="small text-muted mt-1">{{ $r['occupied'] }} / {{ $r['room']->no_of_beds }} beds occupied</div>
            </div>
        </div>
    @endforeach
</div>
@endsection
