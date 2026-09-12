@extends('layouts.app')
@section('title', 'Staff Attendance')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3"><label class="form-label small">Date</label>
            <input type="date" name="date" value="{{ $date }}" class="form-control form-control-sm"></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Load</button></div>
    </form>
</div>
<div class="table-card p-3">
    <form method="POST">@csrf
        <input type="hidden" name="date" value="{{ $date }}">
        <table class="table table-sm table-hover align-middle">
            <thead class="table-light"><tr><th>Staff No</th><th>Name</th><th>Designation</th><th class="text-center">Present</th><th class="text-center">Absent</th><th class="text-center">Late</th><th class="text-center">Leave</th></tr></thead>
            <tbody>
                @foreach ($staffs as $s)
                    @php $st = $existing[$s->id] ?? 'present'; @endphp
                    <tr><td>{{ $s->staff_no }}</td><td>{{ $s->name }}</td><td>{{ $s->designation }}</td>
                        <td class="text-center"><input class="form-check-input" type="radio" name="status[{{ $s->id }}]" value="present" {{ $st === 'present' ? 'checked' : '' }}></td>
                        <td class="text-center"><input class="form-check-input" type="radio" name="status[{{ $s->id }}]" value="absent" {{ $st === 'absent' ? 'checked' : '' }}></td>
                        <td class="text-center"><input class="form-check-input" type="radio" name="status[{{ $s->id }}]" value="late" {{ $st === 'late' ? 'checked' : '' }}></td>
                        <td class="text-center"><input class="form-check-input" type="radio" name="status[{{ $s->id }}]" value="leave" {{ $st === 'leave' ? 'checked' : '' }}></td></tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save Attendance</button>
    </form>
</div>
@endsection
