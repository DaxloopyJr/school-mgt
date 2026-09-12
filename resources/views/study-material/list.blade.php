@extends('layouts.app')
@section('title', $title)
@section('content')
<div class="table-card p-3">
    <h5 class="mb-3">{{ $title }}</h5>
    <div class="row g-3">
        @forelse ($items as $item)
            @php $ext = strtolower(pathinfo($item->file ?? '', PATHINFO_EXTENSION)); @endphp
            <div class="col-md-6">
                <div class="border rounded p-3 d-flex gap-3 align-items-start h-100">
                    <div class="fs-2">
                        @if (in_array($ext, ['jpg','jpeg','png'])) <i class="bi bi-file-image text-success"></i>
                        @elseif ($ext === 'pdf') <i class="bi bi-file-pdf text-danger"></i>
                        @elseif (in_array($ext, ['doc','docx'])) <i class="bi bi-file-word text-primary"></i>
                        @elseif ($ext === 'mp4') <i class="bi bi-camera-video text-danger"></i>
                        @elseif ($ext === 'mp3') <i class="bi bi-music-note-beamed text-warning"></i>
                        @else <i class="bi bi-file-earmark text-secondary"></i>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <strong>{{ $item->title }}</strong>
                        <div class="small text-muted">{{ $item->schoolClass->name ?? 'All classes' }} &middot; {{ $item->subject->name ?? '' }} &middot; {{ $item->upload_date?->toDateString() }}</div>
                        @if ($item->description)<div class="small">{{ \Illuminate\Support\Str::limit($item->description, 100) }}</div>@endif
                    </div>
                    @if ($item->file)
                        <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i></a>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12"><div class="text-muted text-center py-4">No {{ strtolower($title) }} available yet.</div></div>
        @endforelse
    </div>
    <div class="mt-3">{{ $items->links() }}</div>
</div>
@endsection
