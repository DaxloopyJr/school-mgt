@extends('layouts.app')
@section('title', 'My Profile')
@section('content')
<div class="row g-3">
    <div class="col-md-4">
        <div class="table-card p-4 text-center">
            <img src="{{ $user->avatarUrl() }}" class="rounded-circle mb-2" width="90" height="90" alt="">
            <h6 class="mb-0">{{ $user->name }}</h6>
            <div class="small text-muted">{{ $user->email }}</div>
            <span class="badge bg-primary mt-2">{{ ucfirst($user->role) }}</span>
        </div>
    </div>
    <div class="col-md-8">
        <div class="table-card p-4">
            <h6>Update Profile</h6>
            <form method="POST" action="{{ route('panel.profile.update') }}">@csrf
                <div class="mb-2"><label class="form-label small">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required></div>
                <div class="mb-2"><label class="form-label small">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control"></div>
                <div class="row g-2">
                    <div class="col-md-6"><label class="form-label small">New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current"></div>
                    <div class="col-md-6"><label class="form-label small">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control"></div>
                </div>
                <button class="btn btn-primary mt-3"><i class="bi bi-check-lg me-1"></i>Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
