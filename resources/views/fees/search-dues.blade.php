@extends('layouts.app')
@section('title', 'Search Fees Dues')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3"><label class="form-label small">Class</label>
            <select name="class_id" class="form-select form-select-sm" required><option value="">-- Select --</option>
                @foreach ($classes as $id => $name)<option value="{{ $id }}" {{ $class_id == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
            </select></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Search</button></div>
    </form>
</div>
@if ($rows->isNotEmpty())
<div class="table-card p-3">
    <h6>Students with dues</h6>
    <table class="table table-sm table-bordered">
        <thead class="table-light"><tr><th>Roll</th><th>Student</th><th class="text-end">Payable</th><th class="text-end">Paid</th><th class="text-end text-danger">Due</th></tr></thead>
        <tbody>
            @foreach ($rows as $r)
                <tr><td>{{ $r['student']->roll_no }}</td><td>{{ $r['student']->fullName() }}</td>
                    <td class="text-end">{{ number_format($r['payable'], 2) }}</td><td class="text-end">{{ number_format($r['paid'], 2) }}</td>
                    <td class="text-end text-danger fw-bold">{{ number_format($r['due'], 2) }}</td></tr>
            @endforeach
        </tbody>
    </table>
</div>
@elseif (request()->filled('class_id'))
    <div class="alert alert-success">No dues in this class. All fees cleared.</div>
@endif
@endsection
