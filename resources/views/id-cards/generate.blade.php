@extends('layouts.app')
@section('title', 'Generate ID Card')
@section('content')
<div class="table-card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3"><label class="form-label small">Class</label>
            <select name="class_id" class="form-select form-select-sm" required><option value="">-- Select --</option>
                @foreach ($classes as $id => $name)<option value="{{ $id }}" {{ request('class_id') == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
            </select></div>
        <div class="col-md-2"><label class="form-label small">Section</label>
            <select name="section_id" class="form-select form-select-sm"><option value="">All</option>
                @foreach ($sections as $id => $name)<option value="{{ $id }}" {{ request('section_id') == $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach
            </select></div>
        <div class="col-md-2"><button class="btn btn-sm btn-primary w-100">Load Students</button></div>
    </form>
</div>
@if ($students->isNotEmpty())
<div class="table-card p-3">
    <form method="POST">@csrf
        <div class="row g-2 align-items-end mb-3">
            <div class="col-md-4"><label class="form-label small">ID Card Design</label>
                <select name="id_card_id" class="form-select form-select-sm" required>
                    @foreach ($cards as $id => $name)<option value="{{ $id }}">{{ $name }}</option>@endforeach
                </select></div>
            <div class="col-md-3"><button class="btn btn-success"><i class="bi bi-person-badge me-1"></i>Generate</button></div>
        </div>
        <table class="table table-sm table-hover">
            <thead class="table-light"><tr><th><input type="checkbox" onclick="document.querySelectorAll('.stu-check').forEach(c => c.checked = this.checked)"></th><th>Roll</th><th>Student</th></tr></thead>
            <tbody>
                @foreach ($students as $s)
                    <tr><td><input class="stu-check" type="checkbox" name="students[]" value="{{ $s->id }}"></td>
                        <td>{{ $s->roll_no }}</td><td>{{ $s->fullName() }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
@endif
@endsection
