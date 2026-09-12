@extends('layouts.app')
@section('title', 'ID Card ' . $gc->card_no)
@section('content')
<div class="mx-auto" style="max-width: 340px;">
    <div class="card shadow" id="card">
        <div class="card-header bg-primary text-white text-center py-2">
            <strong>{{ config('app.name') }}</strong>
            <div class="small">{{ $gc->card->title ?? 'Student Identity Card' }}</div>
        </div>
        <div class="card-body text-center">
            <img src="{{ $gc->student->photoUrl() }}" class="rounded mb-2" width="90" height="90" alt="">
            <h6 class="mb-0">{{ $gc->student->fullName() }}</h6>
            <div class="small text-muted mb-2">{{ $gc->card_no }}</div>
            <table class="table table-sm table-borderless small text-start">
                <tr><td class="text-muted">Class</td><td>{{ $gc->student->schoolClass->name ?? '-' }} ({{ $gc->student->section->name ?? '' }})</td></tr>
                <tr><td class="text-muted">Roll</td><td>{{ $gc->student->roll_no }}</td></tr>
                <tr><td class="text-muted">Adm. No</td><td>{{ $gc->student->admission_no }}</td></tr>
                <tr><td class="text-muted">Blood</td><td>{{ $gc->student->blood_group ?? '-' }}</td></tr>
                <tr><td class="text-muted">Phone</td><td>{{ $gc->student->phone ?? '-' }}</td></tr>
            </table>
        </div>
        <div class="card-footer text-center small text-muted py-1">Issued: {{ $gc->date?->toDateString() }}</div>
    </div>
    <div class="text-center mt-3">
        <button class="btn btn-outline-secondary" onclick="window.print()"><i class="bi bi-printer me-1"></i>Print</button>
        <a href="{{ route('id-cards.generate') }}" class="btn btn-primary">Generate Another</a>
    </div>
</div>
@endsection
