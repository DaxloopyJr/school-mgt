@extends('layouts.app')
@section('title', 'Manage Questions - ' . $exam->title)
@section('content')
<div class="table-card p-3">
    <div class="d-flex justify-content-between mb-3">
        <h6 class="mb-0">{{ $exam->title }} - select questions from the bank</h6>
        <a href="{{ route('question-banks.create') }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-plus-lg me-1"></i>New Question</a>
    </div>
    <form method="POST">@csrf
        <button class="btn btn-primary btn-sm mb-3"><i class="bi bi-check-lg me-1"></i>Save Selection</button>
        <div class="row g-2">
            @forelse ($bank as $q)
                <div class="col-md-6">
                    <label class="border rounded p-2 d-block small h-100">
                        <input type="checkbox" name="questions[]" value="{{ $q->id }}" {{ in_array($q->id, $attached) ? 'checked' : '' }}>
                        <span class="badge bg-secondary">{{ strtoupper(str_replace('_', ' ', $q->type)) }}</span>
                        <span class="badge bg-light text-dark border">{{ $q->mark }} mark</span>
                        {{ \Illuminate\Support\Str::limit($q->question, 120) }}
                    </label>
                </div>
            @empty
                <div class="col-12 text-muted">Question bank is empty. Add questions first.</div>
            @endforelse
        </div>
    </form>
</div>
@endsection
