@extends('layouts.app')
@section('title', 'Take Exam - ' . $exam->title)
@section('content')
<div class="table-card p-4 mx-auto" style="max-width: 860px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-0">{{ $exam->title }}</h5>
            <div class="small text-muted">{{ $exam->subject->name ?? '' }} &middot; {{ $questions->count() }} questions &middot; {{ $exam->total_mark }} marks</div>
        </div>
        <span class="badge bg-danger fs-6" id="timer">{{ $exam->duration_minutes }}:00</span>
    </div>
    @if ($questions->isEmpty())
        <div class="alert alert-warning">No questions have been attached to this exam yet.</div>
    @else
    <form method="POST" action="{{ route('online-exams.submit', $exam->id) }}" id="examForm">@csrf
        @foreach ($questions as $i => $q)
            <div class="border rounded p-3 mb-3">
                <div class="fw-semibold mb-2">Q{{ $i + 1 }}. {{ $q->question }} <span class="badge bg-light text-dark border">{{ $q->mark }} mark</span></div>
                @if ($q->type === 'mcq')
                    @foreach (['A' => $q->option_a, 'B' => $q->option_b, 'C' => $q->option_c, 'D' => $q->option_d] as $key => $opt)
                        @if ($opt)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answers[{{ $q->id }}]" value="{{ $key }}" id="q{{ $q->id }}{{ $key }}">
                                <label class="form-check-label" for="q{{ $q->id }}{{ $key }}">{{ $key }}. {{ $opt }}</label>
                            </div>
                        @endif
                    @endforeach
                @elseif ($q->type === 'true_false')
                    <div class="form-check"><input class="form-check-input" type="radio" name="answers[{{ $q->id }}]" value="true" id="q{{ $q->id }}t">
                        <label class="form-check-label" for="q{{ $q->id }}t">True</label></div>
                    <div class="form-check"><input class="form-check-input" type="radio" name="answers[{{ $q->id }}]" value="false" id="q{{ $q->id }}f">
                        <label class="form-check-label" for="q{{ $q->id }}f">False</label></div>
                @else
                    <input type="text" name="answers[{{ $q->id }}]" class="form-control" placeholder="Your answer">
                @endif
            </div>
        @endforeach
        <button class="btn btn-success" onclick="return confirm('Submit your answers? This cannot be undone.')"><i class="bi bi-check2-circle me-1"></i>Submit Exam</button>
    </form>
    @endif
</div>
@endsection
@push('scripts')
<script>
(function () {
    let seconds = {{ (int) $exam->duration_minutes * 60 }};
    const el = document.getElementById('timer');
    const form = document.getElementById('examForm');
    const t = setInterval(() => {
        seconds--;
        const m = Math.floor(seconds / 60), s = seconds % 60;
        el.textContent = m + ':' + String(s).padStart(2, '0');
        if (seconds <= 0) { clearInterval(t); if (form) form.submit(); }
    }, 1000);
})();
</script>
@endpush
