@extends('layouts.app')
@section('title', 'Monthly Collection Report')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-2"><label class="form-label small">Year</label><input type="number" name="year" value="{{ $year }}" class="form-control form-control-sm"></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Generate</button></div>
    </form>
</div>
<div class="table-card p-3" style="max-width: 560px;">
    <table class="table table-sm table-bordered">
        <thead class="table-light"><tr><th>Month</th><th class="text-end">Collection</th></tr></thead>
        <tbody>
            @foreach (['January','February','March','April','May','June','July','August','September','October','November','December'] as $i => $m)
                <tr><td>{{ $m }}</td><td class="text-end">{{ number_format($rows[$i + 1] ?? 0, 2) }}</td></tr>
            @endforeach
        </tbody>
        <tfoot class="table-light fw-bold"><tr><td>Total</td><td class="text-end">{{ number_format($grand, 2) }}</td></tr></tfoot>
    </table>
</div>
@endsection
