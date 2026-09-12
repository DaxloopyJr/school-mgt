@extends('layouts.front')
@section('title', 'About Us')
@section('content')
<div class="container mt-4" style="max-width: 820px;">
    <h4>About Us</h4>
    <p>{{ $cms['settings']['about_us'] ?? 'We are a modern educational institution committed to academic excellence, character building, and community engagement. Our campus combines experienced teachers, digital classrooms, and a complete school management platform connecting administrators, teachers, students, and parents.' }}</p>
    <div class="row g-3 mt-2">
        <div class="col-md-4"><div class="border rounded p-3 text-center"><i class="bi bi-people fs-2 text-primary"></i><h6 class="mt-2">Experienced Faculty</h6></div></div>
        <div class="col-md-4"><div class="border rounded p-3 text-center"><i class="bi bi-laptop fs-2 text-primary"></i><h6 class="mt-2">Digital Learning</h6></div></div>
        <div class="col-md-4"><div class="border rounded p-3 text-center"><i class="bi bi-trophy fs-2 text-primary"></i><h6 class="mt-2">Proven Results</h6></div></div>
    </div>
</div>
@endsection
