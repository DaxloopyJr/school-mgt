@extends('layouts.front')
@section('title', $item->title)
@section('content')
<div class="container mt-4" style="max-width: 820px;">
    <h4>{{ $item->title }}</h4>
    <div class="small text-muted mb-3">{{ $item->courseCategory->name ?? '' }} &middot; Duration: {{ $item->duration }} &middot; Fee: {{ number_format($item->fee ?? 0, 2) }}</div>
    @if ($item->image)<img src="{{ asset('storage/' . $item->image) }}" class="img-fluid rounded mb-3" alt="">@endif
    <div>{!! nl2br(e($item->overview)) !!}</div>
    <a href="{{ route('front.contact') }}" class="btn btn-primary mt-3">Enquire Now</a>
</div>
@endsection
