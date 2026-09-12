@extends('layouts.front')
@section('title', 'News')
@section('content')
<div class="container mt-4">
    <h4 class="mb-3">News & Announcements</h4>
    <div class="row g-3">
        @forelse ($items as $n)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @if ($n->image)<img src="{{ asset('storage/' . $n->image) }}" class="card-img-top" alt="">@endif
                    <div class="card-body">
                        <div class="small text-muted">{{ $n->publish_date?->toDateString() }} &middot; {{ $n->newsCategory->name ?? '' }}</div>
                        <h6>{{ $n->title }}</h6>
                        <p class="small text-muted">{{ \Illuminate\Support\Str::limit($n->description, 100) }}</p>
                        <a href="{{ route('front.news.show', $n->id) }}" class="small">Read more</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-muted">No news published yet.</div>
        @endforelse
    </div>
    <div class="mt-3">{{ $items->links() }}</div>
</div>
@endsection
