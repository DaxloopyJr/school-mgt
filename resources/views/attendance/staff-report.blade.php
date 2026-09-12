@extends('layouts.app')
@section('title', 'Staff Attendance Report')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-2"><label class="form-label small">Month</label><input type="number" name="month" min="1" max="12" value="{{ $month }}" class="form-control form-control-sm"></div>
        <div class="col-md-2"><label class="form-label small">Year</label><input type="number" name="year" value="{{ $year }}" class="form-control form-control-sm"></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Generate</button></div>
    </form>
</div>
<div class="table-card p-3">
    <table class="table table-sm table-bordered">
        <thead class="table-light"><tr><th>Staff</th><th>Designation</th><th class="text-center text-success">Present</th><th class="text-center text-danger">Absent</th><th class="text-center text-warning">Late</th><th class="text-center">Leave</th></tr></thead>
        <tbody>
            @foreach ($rows as $r)
                <tr><td>{{ $r['staff']->name }}</td><td>{{ $r['staff']->designation }}</td>
                    <td class="text-center">{{ $r['att']['present'] ?? 0 }}</td><td class="text-center">{{ $r['att']['absent'] ?? 0 }}</td>
                    <td class="text-center">{{ $r['att']['late'] ?? 0 }}</td><td class="text-center">{{ $r['att']['leave'] ?? 0 }}</td></tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
