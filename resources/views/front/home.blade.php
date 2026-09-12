@extends('layouts.front')
@section('title', 'Home')
@section('content')
<section class="hero text-center">
    <div class="container">
        <h1 class="display-5 fw-bold">Welcome to {{ $cms['settings']['school_name'] ?? config('app.name') }}</h1>
        <p class="lead">Quality education, modern management, connected community.</p>
        <a href="{{ route('front.courses') }}" class="btn btn-light me-2">Explore Courses</a>
        <a href="{{ route('front.contact') }}" class="btn btn-outline-light">Contact Us</a>
    </div>
</section>
<div class="container mt-5">
    <h4 class="mb-3"><i class="bi bi-mortarboard me-1 text-primary"></i>Featured Courses</h4>
    <div class="row g-3">
        @forelse ($courses as $c)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @if ($c->image)<img src="{{ asset('storage/' . $c->image) }}" class="card-img-top" alt="">@endif
                    <div class="card-body">
                        <span class="badge bg-primary mb-1">{{ $c->courseCategory->name ?? 'Course' }}</span>
                        <h6 class="card-title">{{ $c->title }}</h6>
                        <p class="card-text small text-muted">{{ \Illuminate\Support\Str::limit($c->overview, 90) }}</p>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between small">
                        <span><i class="bi bi-clock me-1"></i>{{ $c->duration }}</span>
                        <a href="{{ route('front.courses.show', $c->id) }}">Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-muted">Courses will appear here soon.</div>
        @endforelse
    </div>

    <h4 class="mb-3 mt-5"><i class="bi bi-newspaper me-1 text-primary"></i>Latest News</h4>
    <div class="row g-3">
        @forelse ($news as $n)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @if ($n->image)<img src="{{ asset('storage/' . $n->image) }}" class="card-img-top" alt="">@endif
                    <div class="card-body">
                        <div class="small text-muted">{{ $n->publish_date?->toDateString() }} &middot; {{ $n->newsCategory->name ?? '' }}</div>
                        <h6>{{ $n->title }}</h6>
                        <p class="small text-muted">{{ \Illuminate\Support\Str::limit($n->description, 90) }}</p>
                        <a href="{{ route('front.news.show', $n->id) }}" class="small">Read more</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-muted">No news published yet.</div>
        @endforelse
    </div>

    @if ($testimonials->isNotEmpty())
        <h4 class="mb-3 mt-5"><i class="bi bi-chat-quote me-1 text-primary"></i>Testimonials</h4>
        <div class="row g-3 mb-4">
            @foreach ($testimonials as $t)
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm text-center p-3">
                        @if ($t->image)<img src="{{ asset('storage/' . $t->image) }}" class="rounded-circle mx-auto" width="64" height="64" alt="">@endif
                        <p class="small mt-2">"{{ \Illuminate\Support\Str::limit($t->description, 120) }}"</p>
                        <strong class="small">{{ $t->name }}</strong>
                        <span class="text-muted small">{{ $t->designation }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
