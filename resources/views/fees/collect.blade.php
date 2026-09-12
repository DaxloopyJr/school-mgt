@extends('layouts.app')
@section('title', 'Collect Fees')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4"><label class="form-label small">Search student (admission no / name)</label>
            <input type="text" name="search" value="{{ $search }}" class="form-control form-control-sm" required></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100"><i class="bi bi-search me-1"></i>Search</button></div>
    </form>
</div>
@if ($search && !$student)
    <div class="alert alert-warning">No student found for "{{ $search }}".</div>
@endif
@if ($student)
<div class="row g-3">
    <div class="col-lg-4">
        <div class="table-card p-3 text-center">
            <img src="{{ $student->photoUrl() }}" class="rounded-circle mb-2" width="80" height="80" alt="">
            <h6 class="mb-0">{{ $student->fullName() }}</h6>
            <div class="small text-muted">{{ $student->admission_no }} &middot; {{ $student->schoolClass->name ?? '' }} ({{ $student->section->name ?? '' }})</div>
            <hr>
            <div class="d-flex justify-content-between small"><span>Total Payable</span><strong>{{ number_format($student->totalPayable(), 2) }}</strong></div>
            <div class="d-flex justify-content-between small text-success"><span>Total Paid</span><strong>{{ number_format($student->totalPaid(), 2) }}</strong></div>
            <div class="d-flex justify-content-between small text-danger"><span>Balance Due</span><strong>{{ number_format($student->balance(), 2) }}</strong></div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="table-card p-3">
            <h6>Fee Items</h6>
            <table class="table table-sm table-bordered align-middle">
                <thead class="table-light"><tr><th>Group</th><th>Type</th><th class="text-end">Amount</th><th>Due Date</th><th class="text-end">Paid</th><th class="text-end">Due</th><th></th></tr></thead>
                <tbody>
                    @forelse ($masters as $m)
                        @php $p = $paid[$m->id] ?? 0; $due = max(0, $m->amount - $p); @endphp
                        <tr>
                            <td>{{ $m->feesGroup->name ?? '-' }}</td><td>{{ $m->feesType->name ?? '-' }}</td>
                            <td class="text-end">{{ number_format($m->amount, 2) }}</td><td>{{ $m->due_date?->toDateString() }}</td>
                            <td class="text-end text-success">{{ number_format($p, 2) }}</td>
                            <td class="text-end text-danger">{{ number_format($due, 2) }}</td>
                            <td>
                                @if ($due > 0)
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#payModal"
                                        onclick="document.getElementById('pm_master').value={{ $m->id }};document.getElementById('pm_amount').value={{ $due }};">Collect</button>
                                @else
                                    <span class="badge bg-success">Paid</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted">No fees assigned for this class.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="payModal" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <form method="POST" action="{{ route('fees.collect.save') }}">@csrf
            <div class="modal-header"><h6 class="modal-title">Collect Payment</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <input type="hidden" name="student_id" value="{{ $student->id }}">
                <input type="hidden" name="fees_master_id" id="pm_master">
                <div class="mb-2"><label class="form-label small">Amount</label><input type="number" step="0.01" min="0.01" name="amount" id="pm_amount" class="form-control" required></div>
                <div class="row g-2">
                    <div class="col-6"><label class="form-label small">Discount</label><input type="number" step="0.01" min="0" name="discount_amount" value="0" class="form-control"></div>
                    <div class="col-6"><label class="form-label small">Fine</label><input type="number" step="0.01" min="0" name="fine" value="0" class="form-control"></div>
                </div>
                <div class="row g-2 mt-1">
                    <div class="col-6"><label class="form-label small">Date</label><input type="date" name="payment_date" value="{{ date('Y-m-d') }}" class="form-control" required></div>
                    <div class="col-6"><label class="form-label small">Method</label>
                        <select name="method" class="form-select"><option value="cash">Cash</option><option value="bank">Bank</option><option value="cheque">Cheque</option><option value="online">Online</option></select></div>
                </div>
                <div class="mt-2"><label class="form-label small">Note</label><input type="text" name="note" class="form-control"></div>
            </div>
            <div class="modal-footer"><button class="btn btn-success"><i class="bi bi-cash-coin me-1"></i>Collect & Print Invoice</button></div>
        </form>
    </div></div>
</div>
@endif
@endsection
