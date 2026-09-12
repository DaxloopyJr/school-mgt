@extends('layouts.app')
@section('title', $mode === 'subject' ? 'Subject Wise Attendance' : 'Student Attendance')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label small">Class <span class="text-danger">*</span></label>
            <select name="class_id" class="form-select form-select-sm" required>
                <option value="">-- Select --</option>
                @foreach ($classes as $id => $name)<option value="{{ $id }}" {{ $class_id == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label small">Section</label>
            <select name="section_id" class="form-select form-select-sm">
                <option value="">All</option>
                @foreach ($sections as $id => $name)<option value="{{ $id }}" {{ $section_id == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
            </select>
        </div>
        @if ($mode === 'subject')
            <div class="col-md-3">
                <label class="form-label small">Subject <span class="text-danger">*</span></label>
                <select name="subject_id" class="form-select form-select-sm" required>
                    <option value="">-- Select --</option>
                    @foreach ($subjects as $id => $name)<option value="{{ $id }}" {{ $subject_id == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
                </select>
            </div>
        @endif
        <div class="col-md-2">
            <label class="form-label small">Date <span class="text-danger">*</span></label>
            <input type="date" name="date" value="{{ $date }}" class="form-control form-control-sm" required>
        </div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100"><i class="bi bi-search me-1"></i>Load Students</button></div>
    </form>
</div>

@if ($students->isNotEmpty())
<div class="table-card p-3">
    <form method="POST">
        @csrf
        <input type="hidden" name="class_id" value="{{ $class_id }}">
        <input type="hidden" name="section_id" value="{{ $section_id }}">
        @if ($mode === 'subject')<input type="hidden" name="subject_id" value="{{ $subject_id }}">@endif
        <input type="hidden" name="date" value="{{ $date }}">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="mb-0">Attendance for {{ $date }}</h6>
            <button type="button" class="btn btn-sm btn-outline-success" onclick="document.querySelectorAll('.status-p').forEach(r => r.checked = true)">Mark All Present</button>
        </div>
        <table class="table table-sm table-hover align-middle">
            <thead class="table-light"><tr><th>Roll</th><th>Student</th><th class="text-center">Present</th><th class="text-center">Absent</th><th class="text-center">Late</th><th class="text-center">Half Day</th></tr></thead>
            <tbody>
                @foreach ($students as $s)
                    @php $st = $existing[$s->id] ?? 'present'; @endphp
                    <tr>
                        <td>{{ $s->roll_no }}</td>
                        <td>{{ $s->fullName() }}</td>
                        <td class="text-center"><input class="form-check-input status-p" type="radio" name="status[{{ $s->id }}]" value="present" {{ $st === 'present' ? 'checked' : '' }}></td>
                        <td class="text-center"><input class="form-check-input" type="radio" name="status[{{ $s->id }}]" value="absent" {{ $st === 'absent' ? 'checked' : '' }}></td>
                        <td class="text-center"><input class="form-check-input" type="radio" name="status[{{ $s->id }}]" value="late" {{ $st === 'late' ? 'checked' : '' }}></td>
                        <td class="text-center"><input class="form-check-input" type="radio" name="status[{{ $s->id }}]" value="half_day" {{ $st === 'half_day' ? 'checked' : '' }}></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save Attendance</button>
    </form>
</div>
@elseif (request()->filled('class_id'))
    <div class="alert alert-info">No active students found for the selected filters.</div>
@endif
@endsection
