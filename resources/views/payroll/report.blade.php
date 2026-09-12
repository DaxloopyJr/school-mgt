@extends('layouts.app')
@section('title', 'Payroll Report')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3"><label class="form-label small">Month</label>
            <select name="month" class="form-select form-select-sm"><option value="">All</option>
                @foreach (['January','February','March','April','May','June','July','August','September','October','November','December'] as $m)
                    <option value="{{ $m }}" {{ $month === $m ? 'selected' : '' }}>{{ $m }}</option>
                @endforeach
            </select></div>
        <div class="col-md-2"><label class="form-label small">Year</label><input type="number" name="year" value="{{ $year }}" class="form-control form-control-sm"></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Generate</button></div>
        <div class="col-md-2"><button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="window.print()"><i class="bi bi-printer"></i> Print</button></div>
    </form>
</div>
<div class="table-card p-3">
    <table class="table table-sm table-bordered">
        <thead class="table-light"><tr><th>Staff</th><th>Month</th><th>Year</th><th class="text-end">Basic</th><th class="text-end">Allowances</th><th class="text-end">Deductions</th><th class="text-end">Net Salary</th><th>Status</th></tr></thead>
        <tbody>
            @forelse ($rows as $r)
                <tr><td>{{ $r->staff->name ?? '-' }}</td><td>{{ $r->month }}</td><td>{{ $r->year }}</td>
                    <td class="text-end">{{ number_format($r->basic ?? 0, 2) }}</td><td class="text-end">{{ number_format($r->allowances ?? 0, 2) }}</td>
                    <td class="text-end">{{ number_format($r->deductions ?? 0, 2) }}</td><td class="text-end fw-bold">{{ number_format($r->net_salary ?? 0, 2) }}</td>
                    <td><span class="badge bg-{{ $r->status === 'paid' ? 'success' : 'warning' }}">{{ ucfirst($r->status) }}</span></td></tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted py-3">No payroll records.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $rows->links() }}
</div>
@endsection
