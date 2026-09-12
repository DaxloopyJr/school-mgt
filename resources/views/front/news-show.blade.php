@extends('layouts.front')
@section('title', $item->title)
@section('content')
<div class="container mt-4" style="max-width: 820px;">
    <h4>{{ $item->title }}</h4>
    <div class="small text-muted mb-3">{{ $item->publish_date?->toDateString() }} &middot; {{ $item->newsCategory->name ?? '' }}</div>
    @if ($item->image)<img src="{{ asset('storage/' . $item->image) }}" class="img-fluid rounded mb-3" alt="">@endif
    <div>{!! nl2br(e($item->description)) !!}</div>
</div>
@endsection
