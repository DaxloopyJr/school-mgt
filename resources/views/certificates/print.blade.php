@extends('layouts.app')
@section('title', 'Certificate ' . $gc->certificate_no)
@section('content')
<div class="table-card p-5 text-center mx-auto" style="max-width: 800px; border: 6px double #4e73df;" id="cert">
    <div class="small text-muted">{{ $gc->certificate->header_text ?? config('app.name') }}</div>
    <h3 class="my-3" style="font-family: Georgia, serif;">{{ $gc->certificate->name ?? 'Certificate' }}</h3>
    <p class="my-4" style="font-size: 1.1rem; line-height: 2;">
        {!! nl2br(e(str_replace(
            ['{student_name}', '{class}', '{date}'],
            [$gc->student->fullName(), ($gc->student->schoolClass->name ?? '') . ' ' . ($gc->student->section->name ?? ''), $gc->date?->toDateString()],
            $gc->certificate->body ?? ''
        ))) !!}
    </p>
    <div class="d-flex justify-content-between mt-5 small">
        <span>{{ $gc->certificate->footer_text ?? '' }}</span>
        <span>Certificate No: {{ $gc->certificate_no }}</span>
        <span>Date: {{ $gc->date?->toDateString() }}</span>
    </div>
</div>
<div class="text-center mt-3">
    <button class="btn btn-outline-secondary" onclick="window.print()"><i class="bi bi-printer me-1"></i>Print</button>
    <a href="{{ route('certificates.generate') }}" class="btn btn-primary">Generate Another</a>
</div>
@endsection
