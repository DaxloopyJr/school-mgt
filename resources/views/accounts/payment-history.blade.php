@extends('layouts.app')
@section('title', 'Payment History')
@section('content')
<div class="table-card p-3">
    <table class="table table-sm table-hover">
        <thead class="table-light"><tr><th>Date</th><th>Type</th><th>Details</th><th class="text-end">Amount</th></tr></thead>
        <tbody>
            @forelse ($history as $h)
                <tr><td>{{ $h['date'] }}</td><td><span class="badge bg-{{ $h['direction'] === 'in' ? 'success' : 'danger' }}">{{ $h['type'] }}</span></td>
                    <td>{{ $h['title'] }}</td>
                    <td class="text-end {{ $h['direction'] === 'in' ? 'text-success' : 'text-danger' }}">{{ $h['direction'] === 'in' ? '+' : '-' }}{{ number_format($h['amount'], 2) }}</td></tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-3">No transactions yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
