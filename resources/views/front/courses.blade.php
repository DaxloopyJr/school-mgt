@extends('layouts.front')
@section('title', 'Courses')
@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Our Courses</h4>
    <div class="row g-3">
        @forelse ($items as $c)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @if ($c->image)<img src="{{ asset('storage/' . $c->image) }}" class="card-img-top" alt="">@endif
                    <div class="card-body">
                        <span class="badge bg-primary mb-1">{{ $c->courseCategory->name ?? 'Course' }}</span>
                        <h6>{{ $c->title }}</h6>
                        <p class="small text-muted">{{ \Illuminate\Support\Str::limit($c->overview, 100) }}</p>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between small">
                        <span>{{ $c->duration }}</span>
                        <a href="{{ route('front.courses.show', $c->id) }}">Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-muted">Courses will appear here soon.</div>
        @endforelse
    </div>
    <div class="mt-3">{{ $items->links() }}</div>
</div>
@endsection
