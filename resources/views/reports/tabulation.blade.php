@extends('layouts.app')
@section('title', 'Tabulation Sheet Report')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4"><label class="form-label small">Exam</label>
            <select name="exam_id" class="form-select form-select-sm" required><option value="">-- Select --</option>
                @foreach ($exams as $id => $name)<option value="{{ $id }}" {{ request('exam_id') == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
            </select></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Generate</button></div>
    </form>
</div>
@if ($exam)
<div class="table-card p-3">
    <div class="d-flex justify-content-between mb-2"><h6 class="mb-0">{{ $exam->name }} - Tabulation Sheet</h6>
        <button class="btn btn-sm btn-outline-secondary" onclick="window.print()"><i class="bi bi-printer"></i> Print</button></div>
    <div class="table-responsive">
        <table class="table table-sm table-bordered text-center">
            <thead class="table-light"><tr><th class="text-start">Student</th>
                @foreach ($subjects as $sub)<th>{{ $sub->name }}</th>@endforeach
                <th>Total</th></tr></thead>
            <tbody>
                @foreach ($students as $st)
                    @php $total = 0; @endphp
                    <tr><td class="text-start">{{ $st->fullName() }} ({{ $st->roll_no }})</td>
                        @foreach ($subjects as $sub)
                            @php $v = $marks[$st->id][$sub->id] ?? null; $total += $v ?? 0; @endphp
                            <td>{{ $v ?? '-' }}</td>
                        @endforeach
                        <td class="fw-bold">{{ $total }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
