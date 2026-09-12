@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="row g-3 mb-3">
    @php
        $cards = [
            ['label' => 'Active Students', 'value' => $students, 'icon' => 'bi-people-fill', 'color' => '#4e73df'],
            ['label' => 'Teachers', 'value' => $teachers, 'icon' => 'bi-person-workspace', 'color' => '#1cc88a'],
            ['label' => 'Staff Members', 'value' => $staff, 'icon' => 'bi-person-badge', 'color' => '#36b9cc'],
            ['label' => 'Parents', 'value' => $parents, 'icon' => 'bi-person-hearts', 'color' => '#f6c23e'],
            ['label' => 'Present Today', 'value' => $presentToday, 'icon' => 'bi-check2-circle', 'color' => '#1cc88a'],
            ['label' => 'Absent Today', 'value' => $absentToday, 'icon' => 'bi-x-circle', 'color' => '#e74a3b'],
            ['label' => 'Fees Today', 'value' => number_format($feesToday, 2), 'icon' => 'bi-cash-coin', 'color' => '#4e73df'],
            ['label' => 'Fees This Month', 'value' => number_format($feesMonth, 2), 'icon' => 'bi-graph-up', 'color' => '#6f42c1'],
        ];
    @endphp
    @foreach ($cards as $c)
        <div class="col-md-3 col-sm-6">
            <div class="card stat-card shadow-sm" style="border-left-color: {{ $c['color'] }}">
                <div class="card-body d-flex justify-content-between align-items-center py-3">
                    <div>
                        <div class="text-muted small text-uppercase">{{ $c['label'] }}</div>
                        <div class="fs-4 fw-bold">{{ $c['value'] }}</div>
                    </div>
                    <i class="bi {{ $c['icon'] }} fs-1" style="color: {{ $c['color'] }}33;"></i>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="row g-3">
    <div class="col-lg-7">
        <div class="table-card p-3 h-100">
            <h6><i class="bi bi-megaphone me-1"></i>Latest Notices</h6>
            <ul class="list-group list-group-flush small">
                @forelse ($notices as $n)
                    <li class="list-group-item d-flex justify-content-between"><span>{{ $n->title }}</span><span class="text-muted">{{ $n->publish_date }}</span></li>
                @empty
                    <li class="list-group-item text-muted">No notices yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="table-card p-3 h-100">
            <h6><i class="bi bi-calendar-event me-1"></i>Upcoming Events</h6>
            <ul class="list-group list-group-flush small">
                @forelse ($events as $e)
                    <li class="list-group-item d-flex justify-content-between"><span>{{ $e->title }}</span><span class="text-muted">{{ $e->from_date }}</span></li>
                @empty
                    <li class="list-group-item text-muted">No upcoming events.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
