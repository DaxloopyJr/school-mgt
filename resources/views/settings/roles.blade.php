@extends('layouts.app')
@section('title', 'Role Permission')
@section('content')
<div class="table-card p-3">
    <h6>Role Permission Matrix</h6>
    <p class="small text-muted">Permissions are enforced by the <code>role</code> middleware. The matrix below documents the access map of the system.</p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered text-center">
            <thead class="table-light"><tr><th class="text-start">Module</th><th>Admin</th><th>Accountant</th><th>Teacher</th><th>Student</th><th>Parent</th></tr></thead>
            <tbody>
                @php
                    $matrix = [
                        'Administration / Front Office' => [1,0,0,0,0],
                        'Student Info' => [1,0,1,0,0],
                        'Academics' => [1,0,1,0,0],
                        'Study Material' => [1,0,1,1,0],
                        'Lesson Plan' => [1,0,1,0,0],
                        'Fees Collection' => [1,1,0,0,0],
                        'Accounts' => [1,1,0,0,0],
                        'Human Resource' => [1,0,0,0,0],
                        'Examination' => [1,0,1,0,0],
                        'Online Exam' => [1,0,1,1,0],
                        'Homework' => [1,0,1,1,1],
                        'Chat / Communicate' => [1,1,1,1,1],
                        'Library / Inventory / Transport / Dormitory' => [1,0,0,0,0],
                        'Reports' => [1,0,0,0,0],
                        'System Settings' => [1,0,0,0,0],
                        'Own Panel (marks, routine, invoices)' => [1,0,1,1,1],
                    ];
                @endphp
                @foreach ($matrix as $module => $access)
                    <tr><td class="text-start">{{ $module }}</td>
                        @foreach ($access as $a)<td>{!! $a ? '<i class="bi bi-check-circle-fill text-success"></i>' : '<i class="bi bi-x-circle text-muted"></i>' !!}</td>@endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
