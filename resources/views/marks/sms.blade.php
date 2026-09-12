@extends('layouts.app')
@section('title', 'Send Marks by SMS')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4"><label class="form-label small">Exam</label>
            <select name="exam_id" class="form-select form-select-sm" required><option value="">-- Select Exam --</option>
                @foreach ($exams as $id => $name)<option value="{{ $id }}" {{ $exam_id == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
            </select></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Preview</button></div>
    </form>
</div>
@if ($rows->isNotEmpty())
<div class="table-card p-3">
    <table class="table table-sm table-bordered">
        <thead class="table-light"><tr><th>Roll</th><th>Student</th><th>Subjects Recorded</th><th>Total</th></tr></thead>
        <tbody>
            @foreach ($rows as $r)
                <tr><td>{{ $r['student']->roll_no }}</td><td>{{ $r['student']->fullName() }}</td>
                    <td>@foreach ($r['marks'] as $m)<span class="badge bg-light text-dark border">{{ $m->subject->name ?? '' }}: {{ $m->marks }}</span>@endforeach</td>
                    <td><strong>{{ $r['total'] }}</strong></td></tr>
            @endforeach
        </tbody>
    </table>
    <form method="POST">@csrf
        <input type="hidden" name="exam_id" value="{{ $exam_id }}">
        <button class="btn btn-success" onclick="return confirm('Send marks SMS to all guardians?')"><i class="bi bi-chat-dots me-1"></i>Send SMS to Guardians</button>
    </form>
</div>
@endif
@endsection
