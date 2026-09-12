@extends('layouts.app')
@section('title', 'Parent Dashboard')
@section('content')
<h6 class="mb-3"><i class="bi bi-person-hearts me-1"></i>My Children</h6>
<div class="row g-3 mb-3">
    @forelse ($children as $child)
        <div class="col-md-4">
            <div class="table-card p-3 d-flex align-items-center gap-3">
                <img src="{{ $child->photoUrl() }}" class="rounded-circle" width="56" height="56" alt="">
                <div>
                    <div class="fw-bold">{{ $child->fullName() }}</div>
                    <div class="small text-muted">{{ $child->schoolClass->name ?? '-' }} ({{ $child->section->name ?? '-' }}) &middot; Roll {{ $child->roll_no }}</div>
                    <div class="mt-1">
                        <a href="{{ route('panel.marks', ['student' => $child->id]) }}" class="btn btn-sm btn-outline-primary">Marks</a>
                        <a href="{{ route('panel.attendance', ['student' => $child->id]) }}" class="btn btn-sm btn-outline-success">Attendance</a>
                        <a href="{{ route('panel.invoices', ['student' => $child->id]) }}" class="btn btn-sm btn-outline-warning">Invoices</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-info">No children linked to your account yet. Please contact the school office.</div></div>
    @endforelse
</div>
<div class="table-card p-3" style="max-width: 720px;">
    <h6><i class="bi bi-megaphone me-1"></i>Notices</h6>
    <ul class="list-group list-group-flush small">
        @foreach ($notices as $n)
            <li class="list-group-item d-flex justify-content-between"><span>{{ $n->title }}</span><span class="text-muted">{{ $n->publish_date }}</span></li>
        @endforeach
    </ul>
</div>
@endsection
